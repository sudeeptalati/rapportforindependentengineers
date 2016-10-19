<?php

namespace frontend\controllers;


use common\models\Customer;
use common\models\Engineer;
use common\models\Findanengineer;
use common\models\Handyfunctions;
use common\models\Sms;
use common\models\Deadregions;

use Yii;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;


class FindanengineerController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $model = new Findanengineer();
        $all_brands = Handyfunctions::get_all_brands_for_drop_down();
        $all_product_types = Handyfunctions::get_all_product_types_for_drop_down();

        if ($model->load(Yii::$app->request->post())) {


            //echo  $model->town;
            Yii::$app->response->redirect(['findanengineer/engineersearchresults', 'town' => $model->town, 'postcode' => $model->postcode, 'postcode_s' => $model->postcode_s, 'brand_id' => $model->brand_id, 'product_type_id' => $model->product_type_id]);

        } else {
            return $this->render('index', [
                'model' => $model,
                'all_brands' => $all_brands,
                'all_product_types' => $all_product_types,
            ]);
        }

    }


    public function actionFindwtamember()
    {

        $model = new Findanengineer();

        if ($model->load(Yii::$app->request->post())) {


            //echo  $model->town;
            Yii::$app->response->redirect(['findanengineer/engineersearchresults', 'town' => $model->town, 'postcode' => $model->postcode, 'postcode_s' => $model->postcode_s, 'brand_id' => $model->brand_id, 'product_type_id' => $model->product_type_id]);

        } else {
            return $this->render('findwtamember', [
                'model' => $model,

            ]);
        }

    }


    public function actionEngineersearchresults()
    {
        $model = new Findanengineer();

        if ($model->load(Yii::$app->request->post())) {


            $model->brand_name = Handyfunctions::get_brand_name($model->brand_id);
            $model->product_type_name = Handyfunctions::get_product_type_name($model->product_type_id);

            $search_engineer_url = Url::to(['findanengineer/searchengineer', 'postcode_s' => $model->postcode_s, 'brand_id' => $model->brand_id, 'product_type_id' => $model->product_type_id], true);


            $results = Handyfunctions::curl_file_get_contents($search_engineer_url);
            $json_results = json_decode($results);

            if ($json_results->status==='DEAD_REGION')
            {
                $saved_dead_region=$this->insertdeadregion($model);

                $dead_region_error=Handyfunctions::print_model_errors($saved_dead_region);
                if ($dead_region_error)
                    Yii::$app->session->setFlash('error', $dead_region_error);


            }




            return $this->render('engineersearchresults', [
                'json_results' => $json_results,
                'model' => $model,
            ]);

        }






    }//end of  public function actionEngineersearchresults()


    public function actionSendenquiry()
    {
        $postcode = Yii::$app->getRequest()->get('postcode');
        $brand_id = Yii::$app->getRequest()->get('brand_id');
        $product_type_id = Yii::$app->getRequest()->get('product_type_id');
        $engineer_id = Yii::$app->getRequest()->get('engineer_id');


        $find_an_engineer=new Findanengineer();

        if ($brand_id)
            $brand_name = Handyfunctions::get_brand_name($brand_id);
        else
            $brand_name = '';

        if ($product_type_id)
           $product_type_name = Handyfunctions::get_product_type_name($product_type_id);
        else
            $product_type_name ='';


        $new_customer_model = new Customer();

        $new_customer_model->postcode = $postcode;
        $new_customer_model->manufacturer_id = $brand_id;
        $new_customer_model->product_id = $product_type_id;
        $new_customer_model->technician_id = $engineer_id;
        $new_customer_model->ip_address = Yii::$app->request->userIP;
        $new_customer_model->enquiry_number = $new_customer_model->get_last_enquiry_number();


        $all_brands = Handyfunctions::get_all_brands_for_drop_down();
        $all_product_types = Handyfunctions::get_all_product_types_for_drop_down();


        if ($new_customer_model->load(Yii::$app->request->post()) && $new_customer_model->save()) {


            $recipient_emails = array();
            array_push($recipient_emails, $new_customer_model->engineer->email);
            array_push($recipient_emails, $new_customer_model->email);

            $subject = 'UK Whitegoods Repair Request #' . $new_customer_model->enquiry_number;
            $mail_html_content = $this->_prepare_email($new_customer_model);

            $emailsent = '1';//Handyfunctions::sendemail($recipient_emails, $subject, $mail_html_content);


            $sms_sent=array();
            $sms_sent['status']='NOT_SUBSCRIBED';

            ////Check if engineer  have sms credits or not
            if($new_customer_model->engineer->sms_credits!=0)
            {
                $sms=$this->_prepare_sms($new_customer_model);

                $clickatell_response= Yii::$app->clickatell->sendMessage($new_customer_model->engineer->cell, $sms);

                $sms_sent['destination']=$clickatell_response[0]->destination;

                if ($clickatell_response[0]->errorCode)
                {
                    /*echo '<hr>Error in sending sms';
                    echo '<br>'.$clickatell_response[0]->destination;
                    echo '<br>'.$clickatell_response[0]->error;
                    echo '<br>'.$clickatell_response[0]->errorCode;
                    */
                    $sms_sent['status']='ERROR';
                    $sms_sent['message']="Error in sending sms";
                    $sms_sent['reason']=$clickatell_response[0]->error;

                }else
                {
                    $sms_sent['status']='SUCCESS';
                    $sms_sent['message']="<hr><b>Engineer notified by sms</b>";

                    $engineer = Engineer::findOne($engineer_id);
                    $engineer->updateCounters(['sms_credits' => -2]);

                }


            }/////end of if($new_customer_model->engineer->sms_credits!=0)


            $rapport_url=$new_customer_model->engineer->rapport_chs_url;
            $raport_api_key=$new_customer_model->engineer->rapport_api_key;

            $check_rapport_url=$find_an_engineer->check_rapport_url_is_valid($rapport_url,$raport_api_key);
            $sent_to_rapport=array();
            $sent_to_rapport['status']='NOT_SET';
            if ($check_rapport_url=='OK')
            {
                echo '<br>rapport enabled & verified';

                $post_url=$rapport_url.'?r=api/remoteservicecallbooking';

                $c_json=ArrayHelper::toArray($new_customer_model);

                $postdata['postdata']=json_encode($c_json);

                $rapport_response =  Handyfunctions::curl_post_data($post_url, $postdata);

                $rapport_response_json=json_decode($rapport_response);


                if ($rapport_response_json)
                {
                    if ($rapport_response_json->status=='ALL_PCS_SAVED')
                    {
                        $sent_to_rapport['message']='Rapport saved';
                        $sent_to_rapport['status']='OK';
                    }
                    else
                    {
                        $sent_to_rapport['message']='Error in sending to rapport';
                        $sent_to_rapport['status']='NOT_SENT_TO_RAPPORT';
                    }

                }


            }///end of if($new_customer_model->engineer->sms_credits!=0)
            /*else
            {
                echo $check_rapport_url."Either rapport is disabled or there has been some problem in rapport URL";
            }*/





            return $this->render('thankyouenquiryform', [
                'emailsent' => $emailsent,
                'sms_sent' => $sms_sent,
                'sent_to_rapport' => $sent_to_rapport,
                'new_customer_model' => $new_customer_model,
                'mail_html_content' => $mail_html_content,

            ]);

        } else {

            return $this->render('sendenquiryform', [
                'new_customer_model' => $new_customer_model,
                'brand_name' => $brand_name,
                'product_type_name' => $product_type_name,
                'all_brands' => $all_brands,
                'all_product_types' => $all_product_types,
            ]);

        }


    }/////end of  public function actionSendenquiry()




    //////API Json OUTPUT Functions//////

    public function actionSearchengineer()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $postcode_s = Yii::$app->getRequest()->getQueryParam('postcode_s');
        $brand_id = Yii::$app->getRequest()->getQueryParam('brand_id');
        $product_type_id = Yii::$app->getRequest()->getQueryParam('product_type_id');

        $result = array();
        $result['status'] = '';


        if (!empty($postcode_s) && !empty($brand_id) && !empty($product_type_id)) {
            $findmodel = new Findanengineer();
            //check if postcode exists
            if ($findmodel->if_postcode_exists($postcode_s)) {
                $engineers = $findmodel->find_engineer_with($postcode_s, $brand_id, $product_type_id);
                $result['engineers'] = $engineers;
                if (count($engineers) == 0) {
                    $result['status'] = 'DEAD_REGION';
                } else {
                    $result['status'] = 'OK';
                }

            }///end of if ($findmodel->if_postcode_exists($postcode_s))
            else {
                $result['status'] = 'UNKNOWN_POSTCODE';
            }
        }///end of if (!empty($postcode_s) && !empty($brand_id) && !empty($product_type_id) )
        else {
            $result['status'] = 'INVALID_PARAMETERS';
        }

        //echo json_encode($result);
        return $result;


    }


    public function actionAllengineersjson()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return Engineer::find()->select('id, name, wta_member, line_1, line_2, line_3, town, county, postcode_s, postcode_e, latitude, longitude, email, phone, cell, fax')->all();

    }///end of public function actionAllengineersjson()


    public function actionWtamembersjson()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return Engineer::find()->where(['wta_member'=>'1'])->select('id, name, wta_member, line_1, line_2, line_3, town, county, postcode_s, postcode_e, latitude, longitude, email, phone, cell, fax')->all();

    }///end of public function actionAllengineersjson()





    public function actionEnquiryclick()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $engineer_id = Yii::$app->getRequest()->getQueryParam('engineer_id');
        $engineer = Engineer::findOne($engineer_id);
        echo $engineer->updateCounters(['enquiryclicks' => 1]);

    }//end of     public function actionEnquiryclick()


    public function actionPhoneclick()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $engineer_id = Yii::$app->getRequest()->getQueryParam('engineer_id');
        $engineer = Engineer::findOne($engineer_id);
        echo $engineer->updateCounters(['phoneclicks' => 1]);

    }//end of     public function actionEnquiryclick()

    public function actionMapclick()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $engineer_id = Yii::$app->getRequest()->getQueryParam('engineer_id');
        $engineer = Engineer::findOne($engineer_id);
        echo $engineer->updateCounters(['mapclicks' => 1]);

    }//end of     public function actionEnquiryclick()



    private function _prepare_email($customer_model)
    {

        $engg_message = "Dear " . $customer_model->engineer->name . "<br/>";
        $engg_message .= "A repair request has been requested for your company from the following customer, please try to contact the customer as soon as you possibly can as we do say that the customer will have contact within 24 hours or one working day. ";
        $engg_message .= "<br/><br/>";
        $engg_message .= "<h4> Customer Information</h4>";
        $engg_message .= "<table style='width: 600px'>";
        $engg_message .= "<tr><td>Name: </td><td> " . $customer_model->first_name . " " . $customer_model->last_name . "</td></tr>";
        $engg_message .= "<tr><td>Address:<br/><br/><br/></td><td>  " . $customer_model->line_1 . "<br/> " . $customer_model->line_2 . "<br/>";
        $engg_message .= "<tr><td>Town: </td><td> " . $customer_model->town . "</td></tr>";
        $engg_message .= "<tr><td>Postcode: </td><td> " . $customer_model->postcode . "</td></tr>";
        $engg_message .= "<tr><td>Telephone:  </td><td>" . $customer_model->telephone . "</td></tr>";
        $engg_message .= "<tr><td>Mobile: </td><td> " . $customer_model->cell . "</td></tr>";
        $engg_message .= "<tr><td>Email: </td><td> " . $customer_model->email . "</td></tr>";
        $engg_message .= "<tr><td>Preferred Contact Method: </td><td> " . $customer_model->preferred_contact_method . "</td></tr>";
        //$engg_message .= "<tr><td>Preferred Date of Visit: </td><td> ".$customer_model.":<b>".$contact_time."</b></td></tr>";
        $engg_message .= "<tr><td colspan='2'><br></td></tr>";
        $engg_message .= "<tr><td colspan='2'><h5>Appliance Details</h5></td></tr>";
        $engg_message .= "<tr><td>Product Make:  </td><td>" . $customer_model->brand->manufacturer . "</td></tr>";
        $engg_message .= "<tr><td>Product Type: </td><td>" . $customer_model->producttype->product_type . "</td></tr>";
        $engg_message .= "<tr><td>Model Number:  </td><td>" . $customer_model->model_number . "</td></tr>";
        //$engg_message .= "<tr><td>Serial Number:  </td><td>".$serial_number."</td></tr>";
        //$engg_message .= "<tr><td>Service/S/PNC/etc.  </td><td>".$service_pnc_etc_number."</td></tr>";
        $engg_message .= "<tr><td>Fault:  </td><td>" . $customer_model->fault_description . "</td></tr>";
        $engg_message .= "<tr><td>Other Notes  </td><td>" . $customer_model->other_notes . "</td></tr>";
        $engg_message .= "</table>";

        $engg_message .= "<br/><br/><hr/>";
        $engg_message .= "<small>This referral service is provided freely and UK Whitegoods offers no warranty on the service.</small>";

        return $engg_message;

    }




    private function _prepare_sms($customer_model)
    {
        $sms_content="A repair request has been placed on your account. /n  Customer Details";
        $sms_content.="/n Name: ".$customer_model->title.' '.$customer_model->last_name;
        $sms_content.="/n Address: ".Handyfunctions::formataddress($customer_model->line_1, $customer_model->line_2, $customer_model->line_3, $customer_model->town, $customer_model->postcode);
        $sms_content.="/n Telephone: ".$customer_model->telephone;
        $sms_content.="/n Mobile: ".$customer_model->cell;
        $sms_content.="/n Email: ".$customer_model->email;

        return $sms_content;

    }///end of     private function _prepare_sms($customer_model)


    protected function insertdeadregion($model)
    {

        $deadregion=new Deadregions();
        $deadregion->postcode=$model->postcode;
        $deadregion->product_type_name=$model->product_type_name;
        $deadregion->brand_name=$model->brand_name;
        $deadregion->postcode_s=$model->postcode_s;
        $deadregion->postcode_e=$model->postcode_e;
        $deadregion->manufacturer_id=$model->brand_id;
        $deadregion->product_id=$model->product_type_id;
        $deadregion->resolved=0;
        $deadregion->ip_address=Yii::$app->request->getUserIP();
        $deadregion->latitude=$model->latitude;
        $deadregion->longitude=$model->longitude;
        $deadregion->save();

        return $deadregion;

    }////end of protected function insertdeadregion($postcode_s,$brand_id,$product_type_id)



}
