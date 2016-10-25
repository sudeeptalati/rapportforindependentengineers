<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 14/09/2016
 * Time: 11:37
 */

namespace common\models;

use Yii;
use yii\base\Model;

use yii\helpers\ArrayHelper ;
use yii\helpers\Html ;


/**
 * Handyfunctions class
 */
class Handyfunctions extends Model
{

    public static function get_todays_date_string()
    {
        return date('d-F-Y'); ///12-October-2016
    }




    public static function get_weekday_string($int_date)
    {
        //A full textual representation of the day of the week	Sunday through Saturday
        return date('l',$int_date);
    }

    public static function get_date_of_month($int_date)
    {
        return date('j',$int_date); ///Day of the month without leading zeros	1 to 31
    }

    public static function get_month_string($int_date)
    {
        return date('F',$int_date); ///October
    }
    public static function get_month_digit($int_date)
    {
        return date('m',$int_date); /// 01 through 12
    }

    public static function get_year_string($int_date)
    {
        return date('Y',$int_date); ///2016
    }

    public static function get_no_of_days_in_month($int_date)
    {
        //	Number of days in the given month	28 through 31
        return date('t',$int_date);
    }

    public static function get_weekday_no_on_date($int_date)
    {
        //ISO-8601 numeric representation of the day of the week (added in PHP 5.1.0)
        // 1 (for Monday) through 7 (for Sunday)
        return date('N',$int_date);
    }


    public static function get_first_date_of_month_string($int_date)
    {
        $month_string=Handyfunctions::get_month_string($int_date);
        $year_digit=Handyfunctions::get_year_string($int_date);
        return '01-'.$month_string.'-'.$year_digit;
    }



    public static function get_first_date_of_previous_month_string($date_string)
    {
        return date("d-F-Y", strtotime($date_string."first day of previous month"));
    }

    public static function get_first_date_of_next_month_string($date_string)
    {
        return date("d-F-Y", strtotime($date_string."first day of next month"));
    }


    public static function get_previous_day($date_string)
    {
        return date("d-F-Y", strtotime($date_string." -1 day"));
    }

    public static function get_next_day($date_string)
    {
        return date("d-F-Y", strtotime($date_string." +1 day"));
    }





    public static function istodaysdate($date_string)
    {
        $todays_date=Handyfunctions::get_todays_date_string();

        $date1=date_create($todays_date);
        $date2=date_create($date_string);
        $diff=date_diff($date1,$date2);
        $diff_str= $diff->format('%a');

        if ($diff_str=='0')
            return true;
        else
            return false;
    }////end of  public static function istodaysdate($date_string)





    public static function get_support_email()
    {
       return Html::mailto('Contact us', 'admin@ukwhitegoods.co.uk');
    }

    ////Brand
    public static function get_all_brands_for_drop_down()
    {
        return ArrayHelper::map(Brand::find()->orderBy(['name'=>SORT_ASC])->all(), 'id', 'name');
    }//    public function get_all_brands_for_drop_down()

    public static function get_brand_name($brand_id)
    {
        return Brand::findOne($brand_id)->manufacturer;
    }//    public function get_all_brands_for_drop_down()



    ////Product Type
    public static function get_all_product_types_for_drop_down()
    {
        return ArrayHelper::map(Producttype::find()->orderBy(['name'=>SORT_ASC])->all(), 'id', 'name');
    }//    public function get_all_brands_for_drop_down()

    public static function get_product_type_name($product_type_id)
    {
        return Producttype::findOne($product_type_id)->product_type;
    }///end of     public static function get_product_type_name()



    /////Engineer

    public function get_all_brands_of_engineer_for_drop_down($engineer_id)
    {

        $engineer=Engineer::findOne($engineer_id);


        $engineer_brands_array=array();
        foreach ($engineer->engineerbrands as $brand)
        {
            $b_array=array();
            $b_array['manufacturer_id']=$brand->brandname->manufacturer_id;
            $b_array['manufacturer']=$brand->brandname->manufacturer;
            array_push($engineer_brands_array,$b_array);
        }
        $engineer_brands_drop_down_list=ArrayHelper::map($engineer_brands_array,'manufacturer_id','manufacturer');
        asort($engineer_brands_drop_down_list);
        return $engineer_brands_drop_down_list;

    }////end of     public function get_all_brands_of_engineer_for_drop_down()



    public function get_all_product_types_of_engineer_for_drop_down($engineer_id)
    {

        $engineer=Engineer::findOne($engineer_id);


        $engineer_product_types_array=array();


        foreach ($engineer->engineerproducttypes as $product_type)
        {
            $p_array=array();
            $p_array['product_id']=$product_type->productnames->product_id;
            $p_array['product_type']=$product_type->productnames->product_type;
            array_push($engineer_product_types_array,$p_array);
        }
        $engineer_product_type_drop_down_list=ArrayHelper::map($engineer_product_types_array,'product_id','product_type');
        asort($engineer_product_type_drop_down_list);
        return $engineer_product_type_drop_down_list;

    }////end of     public function get_all_brands_of_engineer_for_drop_down()



    public static function get_all_engineers_for_drop_down()
    {
        return ArrayHelper::map(Engineer::find()->orderBy(['name'=>SORT_ASC])->all(), 'id', 'name');
    }//    public function  get_all_engineers_for_drop_down()

    public static function get_engineer_by_user_id($user_id)
    {
        return Engineer::find()->where(['user_id'=>$user_id])->one();
    }///end of     public static get_engineer_name($engineer_id)

    public static function get_engineer_name($engineer_id)
    {
        return Engineer::findOne($engineer_id)->name;
    }///end of     public static get_engineer_name($engineer_id)

    public static function get_engineer_town($engineer_id)
    {
        return Engineer::findOne($engineer_id)->town;
    }///end of     public static get_engineer_name($engineer_id)

    public static function name_title()
    {
        return [
            'Mr'=>'Mr',
            'Ms'=>'Ms',
            'Mrs'=>'Mrs',
            'Miss'=>'Miss',
            'Dr'=>'Dr',
            'Sir'=>'Sir',
            'Lady'=>'Lady',
            'Lord'=>'Lord',


        ];
    }///end of     public static function preferred_contact_method_drop_down()



    public static function preferred_contact_method_drop_down()
    {
        return [
            'mobile'=>'Mobile',
            'telephone'=>'Telephone',
            'email'=>'email',
            'any'=>'Any',

        ];
    }///end of     public static function preferred_contact_method_drop_down()

    public static function hear_about_us_drop_down()
    {
        return [
            'search_engine'=>'Google or other search',
            'word_of_mouth'=>'Word of mouth',
            'social_media'=>'Social media (facebook, twitter)',
            'advertisement'=>'Advertisement (TV or Radio)',
            'conference'=>'Business Conference',

        ];

    }///end of     public static function hear_about_us_drop_down()



    ////Font awesome icons////

    public static function getawesomeapplianceicon($producttypename)
    {
        $producttypename = strtolower($producttypename);
        $producttypename = preg_replace('/\s+/', '', $producttypename);
        return '<i class="ukwfa ukwfa-' . $producttypename . '"></i>';

    }///end of public function getawesomeapplianceicon()

    public static function getawesomebrandicon($brandname)
    {
        $brandname = strtolower($brandname);
        $brandname = preg_replace('/\s+/', '', $brandname);
        return '<i class="ukw-logo-fa ukw-logo-fa-' . $brandname .'"></i>';


    }///end of public function getawesomebrandicon()


    public static function curl_file_get_contents($request)
    {
        $curl_req = curl_init($request);
        curl_setopt($curl_req, CURLOPT_URL, $request);
        curl_setopt($curl_req, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl_req, CURLOPT_HEADER, FALSE);
        $contents = curl_exec($curl_req);
        curl_close($curl_req);

        return $contents;

    }///end of functn curl File get contents



    public static function curl_file_get_contents_by_sslurl($httpsurl)
    {
        define('DS', DIRECTORY_SEPARATOR);
        $ch = curl_init();
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, $httpsurl);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $certificatepath=getcwd().DS.'protected'.DS.'config'.DS.'cacert.pem';

        curl_setopt ($ch, CURLOPT_CAINFO, $certificatepath);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // grab URL and pass it to the browser
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;

    }//end of curl_file_get_contents_by_sslurl

    public static function curl_post_data($url, $data)
    {
        $curl_req = curl_init();
        curl_setopt($curl_req, CURLOPT_URL, $url);
        curl_setopt($curl_req, CURLOPT_POST, 1);
        curl_setopt($curl_req, CURLOPT_POSTFIELDS,$data);
        curl_setopt($curl_req, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl_req, CURLOPT_HEADER, FALSE);
        $contents = curl_exec($curl_req);
        curl_close($curl_req);

        return $contents;

    }///end of functn curl File get contents






    public static function sendemail($recipient_emails,$subject,$mail_html_content)
    {
        $from_email='mailtest.test10@gmail.com';

        $plaintext=strip_tags($mail_html_content);

        return Yii::$app->mailer->compose()
            ->setFrom($from_email)
            ->setTo($recipient_emails)
            ->setSubject($subject)
            ->setTextBody($plaintext)
            ->setHtmlBody($mail_html_content)
            ->send();

    }///end of     public static function sendemail($to,$subject,$msg)


    public static function print_model_errors($model)
    {
        $error_msg=false;
        $errors=$model->getErrors();
        foreach ($errors as $key=>$value)
            $error_msg.="<br>".$value[0];

        //$this->redirect(array('servicecall/view', 'id' => $servicecall_id, 'error_msg='=>$error_msg));
        return $error_msg;

    }///end of  public static function print_model_errors($model)


    public static function format_date($int_date)
    {
        return date('d-F-Y',$int_date); ///12-October-2016
    }

    public static function format_time($int_date)
    {
        //H	24-hour format of an hour with leading zeros	00 through 23
        //i	Minutes with leading zeros	00 to 59
        return date('H:i',$int_date);

    }


    public static function formataddress($line1, $line2, $line3, $town, $postcode)
    {
        $address_html=Handyfunctions::formataddressinhtml($line1, $line2, $line3, $town, $postcode);
        $address = str_replace("<br>", " ", $address_html);
        return $address;

    }
    public static function formataddressinhtml($line1, $line2, $line3, $town, $postcode)
    {
        $line1 = trim($line1);
        $line2 = trim($line2);
        $line3 = trim($line3);
        $town = trim($town);
        $postcode = trim($postcode);
        $address = '';

        if ($line1 != '' || $line1 != NULL) {
            $address = $address . $line1;
        }

        if ($line2 != '' || $line2 != NULL) {
            $address = $address . '<br>' . $line2;
        }

        if ($line3 != '' || $line3 != NULL) {
            $address = $address . '<br>' . $line3;
        }

        if ($town != '' || $town != NULL) {
            $address = $address . '<br>' . $town;
        }

        if ($postcode != '' || $postcode != NULL) {
            $address = $address . '<br>  ' . strtoupper($postcode);
        }

        return $address;

    }///end of formataddress


    public static function formatphonenoforuk($mobile)
    {

        $mobile = preg_replace('/\s+/', '', $mobile);

        if (strlen($mobile)!=0)
        {

            ///If first two places are 44
            if (substr($mobile, 0, 2) == '44') {
                $mobile='+'.$mobile;
            }

            ///If first place is 0
            if (substr($mobile, 0, 1) == '0')
            {
                $mobile=$mobile;
                $mobile = substr($mobile, 1);
                $mobile='+44'.$mobile;
            }

            $mobile = preg_replace('/\s+/', '', $mobile);
            return $mobile;
        }else
        {
            return false;
        }

    }//public static function formatphonenoforuk() {


    public static function get_telephone_link($tel)
    {
        $tel=self::formatphonenoforuk($tel);
        $options['href'] = 'tel:' .$tel;
        return Html::tag('a', $tel, $options);
    }///////end of     public static function get_telephone_link($tel)







    public static function decode_json_string($string) {
        $string=trim($string);

        if (empty($string))
        {
            return false;
        }
        else
        {
            $result_json=json_decode($string);
            if (json_last_error()==JSON_ERROR_NONE)
                return $result_json;
            else
                //echo  json_last_error_msg();
                return false;
        }

    }///end of  public static function decode_json_string($string) {




}///end of class Handyfunctions