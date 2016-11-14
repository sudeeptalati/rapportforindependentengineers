<?php

namespace frontend\controllers;

use common\models\Emailservicecall;
use common\models\Changeservicecallstatus;
use common\models\Setup;
use Yii;
use common\models\Servicecall;
use common\models\ServicecallSearch;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use mPDF;


use common\models\Handyfunctions;


/**
 * ServicecallController implements the CRUD actions for Servicecall model.
 */
class ServicecallController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Servicecall models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServicecallSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Servicecall model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Servicecall model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Servicecall();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Servicecall model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    public function actionNavigatetoaddress()
    {
        $servicecall_id= Yii::$app->getRequest()->get('servicecall_id');
        //http://maps.google.com/?saddr=Current%20Location&daddr=<?php echo $customer_address;
        $model=$this->findModel($servicecall_id);

        $customer_address = Handyfunctions::formataddress(
            $model->customer->address_line_1,
            $model->customer->address_line_2,
            $model->customer->address_line_3,
            $model->customer->town,
            $model->customer->postcode
        );

        $navigation_url="http://maps.google.com/?saddr=Current%20Location&daddr=".$customer_address;

        $ontheway_jobstatus_id='22';

        Servicecall::update_jobstatus($ontheway_jobstatus_id, $servicecall_id);

        return $this->redirect($navigation_url);




    }/////end of     public function actionNavigatetoaddress()



    public function actionUpdateeditservicecallonly()
    {
        $enggdiary_id= Yii::$app->getRequest()->get('enggdiary_id');
        $servicecall_id= Yii::$app->getRequest()->get('servicecall_id');
        $model = $this->findModel($servicecall_id);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Service Details Updated');
            return $this->redirect(['enggdiary/viewappointment', 'servicecall_id' => $servicecall_id, 'enggdiary_id'=>$enggdiary_id, 'servicecall_block'=>'true', '#'=>'servicecallbox']);
        } else {

            Yii::$app->session->setFlash('warning', 'Try again from here');
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    public function actionChangestatus()
    {


        $change_status_model=new Changeservicecallstatus();
		if ($change_status_model->load(Yii::$app->request->get()))
		{
			$servicecall_id= $change_status_model->servicecall_id;
        	$job_status_id= $change_status_model->job_status_id;
		}


		if ( Yii::$app->request->get('servicecall_id') &&  Yii::$app->request->get('job_status_id'))
		{
			$servicecall_id= Yii::$app->request->get('servicecall_id');
        	$job_status_id= Yii::$app->request->get('job_status_id');
        }



        $model = $this->findModel($servicecall_id);

        $status_updated=$model->update_jobstatus($job_status_id,$servicecall_id);
        if ($status_updated){
            ///we need to reload the model to get new job status
            $model = $this->findModel($servicecall_id);
            Yii::$app->session->setFlash('success', 'Service call # '.$model->service_reference_number.' status changed to '.$model->jobstatus->html_name);
            return $this->redirect(['enggdiary/showappointmentsfordate']);
        } else {

            Yii::$app->session->setFlash('warning', 'There was some problem in updating the job. Please try again');
            return $this->render('update', [
                'model' => $model,
            ]);
        }



    }/////end of public function actionJobfinished()



    public function actionJobsheet()
    {
        $servicecall_id= Yii::$app->getRequest()->get('id');
        //echo $servicecall_id;
        $model=$this->findModel($servicecall_id);
        $company_details=Setup::loadmycompanydetails();

        $filename = 'Job Sheet '.$model->product->producttitle." Repair - Ref No# ".$model->service_reference_number;

        $mpdf=new mPDF();
        $mpdf->WriteHTML($this->renderPartial('jobsheet',  ['model' => $model, 'company_details'=>$company_details]));
        $mpdf->Output($filename , 'I');
    }///end of public function actionJobsheet()


    public function actionInvoice()
    {
        $servicecall_id= Yii::$app->getRequest()->get('id');
        //echo $servicecall_id;
        $model=$this->findModel($servicecall_id);
        $company_details=Setup::loadmycompanydetails();
        $filename = 'Invoice '.$model->product->producttitle." Repair - Ref No# ".$model->service_reference_number;
		return $this->renderPartial('jobsheet',  ['model' => $model, 'company_details'=>$company_details]);

		/*
        $mpdf=new mPDF();
        $mpdf->WriteHTML($this->renderPartial('invoice',  ['model' => $model, 'company_details'=>$company_details]));
        //$mpdf->Output($filename, 'I');
        return $this->renderPartial('invoice',  ['model' => $model, 'company_details'=>$company_details]);
		*/
    }///end of public function actionInvoice()






    public function actionEmailservicecall()
    {
        $echo= "Emailing to ";

        $email_servicecall=new Emailservicecall();


        if ($email_servicecall->load(Yii::$app->request->post()))
        {
            $echo.= $email_servicecall->email;
            $echo.= $email_servicecall->servicecall_id;
            $echo.= "<br>enggdiary_id : ".$email_servicecall->enggdiary_id;

            $echo.= "<br>Invoice : ".$email_servicecall->invoice;
            $echo.= "<br>Job Sheet : ".$email_servicecall->jobsheet;





            $servicecall=$this->findModel($email_servicecall->servicecall_id);
            $company_details=Setup::loadmycompanydetails();

            $from_email=Yii::$app->params['mail_email_from'];

            $recipient_emails=array();

            array_push($recipient_emails,$email_servicecall->email);
            array_push($recipient_emails,$company_details->email);





            $subject = $servicecall->product->producttitle." Repair - Ref No# ".$servicecall->service_reference_number;

            $echo.= "<hr>Subject :".$subject;
            $plaintext="Please find the documents";

            $mail_html_content='<p>Dear '.$servicecall->customer->fullname.'</p>';
            $mail_html_content.='<p>Please find here the enclosed document regarding the repair.</p>';
            $mail_html_content.='<br><p>Kind Regards</p><br>';
            $mail_html_content.='<p>'.$company_details->company;
            $mail_html_content.='<br/>'.$company_details->email;
            $mail_html_content.='<br/>'.$company_details->website.'</p>';


            $echo.= "<hr>Content :".$mail_html_content;

            if ($email_servicecall->jobsheet)
            {

                $attachment_filename='Job Sheet '.$subject.'.pdf';
                $attachment_url=Url::to(['servicecall/jobsheet','id'=> $email_servicecall->servicecall_id],true);
                $subject = "Job Sheet ".$subject;

                $echo.=Yii::$app->mailer->compose()
                    ->setFrom($from_email)
                    ->setTo($recipient_emails)
                    ->setSubject($subject)
                    ->setTextBody($plaintext)
                    ->setHtmlBody($mail_html_content)
                    ->attach($attachment_url,['fileName'=>$attachment_filename])
                    ->send();

            }


            if ($email_servicecall->invoice)
            {

                $attachment_filename='Invoice '.$subject.'.pdf';
                $attachment_url=Url::to(['servicecall/invoice','id'=> $email_servicecall->servicecall_id],true);
                $subject = "Invoice ".$subject;

                $echo.= Yii::$app->mailer->compose()
                    ->setFrom($from_email)
                    ->setTo($recipient_emails)
                    ->setSubject($subject)
                    ->setTextBody($plaintext)
                    ->setHtmlBody($mail_html_content)
                    ->attach($attachment_url,['fileName'=>$attachment_filename])
                    ->send();

            }

            Yii::$app->session->setFlash('success', 'The email has been sent! <i class="fa fa-smile-o fa-2x" aria-hidden="true"></i>');
            return $this->redirect(['enggdiary/viewappointment', 'servicecall_id' => $servicecall->id, 'enggdiary_id'=>$email_servicecall->enggdiary_id, '#'=>'job_status_dropdown_block' ]);
            //return $this->redirect(['enggdiary/viewappointment']);


            /*
            echo
            */


        }else
        {
            Yii::$app->session->setFlash('error', 'Error in sending emails. <i class="fa fa-frown-o" aria-hidden="true"></i> ');
            return $this->redirect(['enggdiary/viewappointment', 'servicecall_id' => $servicecall->id, 'enggdiary_id'=>$email_servicecall->enggdiary_id]);
        }

        //getting pdfs

        ///sendin
	         echo 	$echo;
    }////emd pf     public function actionEmailservicecall()



    /**
     * Deletes an existing Servicecall model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        /*
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
        */
    }

    /**
     * Finds the Servicecall model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Servicecall the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Servicecall::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
