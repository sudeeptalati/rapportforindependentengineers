<?php

/**
 * This is the model class for table "notification_rules".
 *
 * The followings are the available columns in table 'notification_rules':
 * @property integer $id
 * @property integer $job_status_id
 * @property string $active
 * @property integer $customer_notification_code
 * @property integer $engineer_notification_code
 * @property integer $warranty_provider_notification_code
 * @property string $notify_others
 * @property string $created
 * @property string $modified
 * @property string $delete
 *
 * The followings are the available model relations:
 * @property JobStatus $jobStatus
 * @property NotificationCode $warrantyProviderNotificationCode
 * @property NotificationCode $engineerNotificationCode
 * @property NotificationCode $customerNotificationCode
 */
class NotificationRules extends CActiveRecord
{
	public $status_changed;
	public $customer_notification;
	public $engineer_notification;
	public $warranty_provider_notification;
	public $created;
	public $custom_column;

	/**
	 * Returns the static model of the specified AR class.
	 * @return NotificationRules the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'notification_rules';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email_template, sms_template, frequency, job_status_id', 'required'),
			array('job_status_id, customer_notification_code, engineer_notification_code, warranty_provider_notification_code', 'numerical', 'integerOnly' => true),
			array('active, notify_others, created, modified, delete', 'safe'),
			//array('job_status_id', 'unique', 'message' => '{attribute}:{value} already exists!'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('email_template, sms_template, frequency, id, job_status_id, active, customer_notification_code, engineer_notification_code, warranty_provider_notification_code, notify_others, created, modified, delete', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'jobStatus' => array(self::BELONGS_TO, 'JobStatus', 'job_status_id'),
			'warrantyProviderNotificationCode' => array(self::BELONGS_TO, 'NotificationCode', 'warranty_provider_notification_code'),
			'engineerNotificationCode' => array(self::BELONGS_TO, 'NotificationCode', 'engineer_notification_code'),
			'customerNotificationCode' => array(self::BELONGS_TO, 'NotificationCode', 'customer_notification_code'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'job_status_id' => 'Job Status',
			'active' => 'Enable this Rule',
			'customer_notification_code' => 'Customer ',
			'engineer_notification_code' => 'Engineer ',
			'warranty_provider_notification_code' => 'Warranty Provider ',
			'notify_others' => 'Notify Others',
			'created' => 'Created on',
			'modified' => 'Last Modified on',

			'delete' => 'Delete',

			'email_template' => 'Email Template',
			'sms_template' => 'Sms Template',
			'frequency' => 'Frequency of this Rule',

		);
	}


	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->with = array('jobStatus');
		$criteria->compare('jobStatus.name', $this->status_changed, true);

		$criteria->compare('id', $this->id);
		$criteria->compare('job_status_id', $this->job_status_id);
		$criteria->compare('active', $this->active, true);
		$criteria->compare('customer_notification_code', $this->customer_notification_code);
		$criteria->compare('engineer_notification_code', $this->engineer_notification_code);
		$criteria->compare('warranty_provider_notification_code', $this->warranty_provider_notification_code);
		$criteria->compare('notify_others', $this->notify_others, true);
		$criteria->compare('created', $this->created, true);
		$criteria->compare('modified', $this->modified, true);
		$criteria->compare('delete', $this->delete, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}



	protected function beforeSave()
	{
		if (parent::beforeSave()) {
			//********** Creating new record
			if ($this->isNewRecord) {
				$this->created = time();
				return true;
			}//END OF IF NEW RECORD.
			else {
				$this->modified = time();
				return true;
			}//END OF ELSE, THIS BIT IS CALLED IN UPDATE.

		}//end of if(parent())
	}//end of beforeSave().


	protected function afterSave()
	{

	}//end of afterSave().


	public function getNotificationCode($email_status, $sms_status)
	{
		$email_value;
		$sms_value;
		/**RETURNING CODE IS (Refer Table)
		 *    0- NONE
		 *    1- Email Only
		 *  2- SMS Only
		 *  3- Email & SMS
		 * */
		//echo "in model method";
		$emailNotificationCodeModel = NotificationCode::model()->findByAttributes(
			array(
				'notify_by' => 'email'
			));
		//echo "<hr>EMAIL id got from db using findall = ".$emailNotificationCodeModel->id;	
		$emailNotifyId = $emailNotificationCodeModel->id;

		$smsNotificationCodeModel = NotificationCode::model()->findByAttributes(
			array(
				'notify_by' => 'sms'
			));
		//echo "<hr>SMS id got from db using findall = ".$smsNotificationCodeModel->id;
		$smsNotifyId = $smsNotificationCodeModel->id;

		if ($email_status == true) {
			//$email_value=1;	///*You can also write logic here to get email code by findAllByAttribute and sending value as 'email' *//
			$email_value = $emailNotifyId;
		} else {
			$email_value = 0;
		}

		if ($sms_status == true) {
			//$sms_value=2;	///*You can also write logic here to get email code by findAllByAttribute and sending value as 'sms' *//
			$sms_value = $smsNotifyId;
		} else {
			$sms_value = 0;
		}

		$notification_code = $email_value + $sms_value;
		return $notification_code;


	}///end of function getNotificationCode($email_status,$sms_status)

	public function getEmailCheckBoxStatus($notification_code)
	{
		switch ($notification_code) {

			case 0://*Since none is value of 0*//
				return false;
				break;
			case 1://*Since Email only is value of 1*//
				return true;
				break;
			case 2://*Since SMS only is value of 1*//
				return false;
				break;
			case 3://*Since Email & SMS is value of 3*//
				return true;
				break;

		}//end of switch
	}//getEmailCheckBoxStatus($notification_code)


	public function getSMSCheckBoxStatus($notification_code)
	{
		switch ($notification_code) {

			case 0://*Since none is value of 0*//
				return false;
				break;
			case 1://*Since Email only is value of 1*//
				return false;
				break;
			case 2://*Since SMS only is value of 1*//
				return true;
				break;
			case 3://*Since Email & SMS is value of 3*//
				return true;
				break;

		}//end of switch
	}//getEmailCheckBoxStatus($notification_code)

	public function notifyByEmailAndSms($receiver_email_address, $telephone, $notificaionCode, $body, $subject, $smsMessage, $frequency_type)
	{

		$response_array = array();
		switch ($notificaionCode) {
			case 1:
				//echo "<br>Send email";
				$this->_prepareemail($receiver_email_address, $body, $subject, $frequency_type);


			case 2:
				//echo "<br>Send SMS";
				$this->_preparesms($smsMessage, $telephone, $frequency_type);
				break;

			case 3:
				///echo "<br>Send email and SMS also";
				$this->_preparesms($smsMessage, $telephone, $frequency_type);
				$this->_prepareemail($receiver_email_address, $body, $subject, $frequency_type);
				break;

		}//end of switch().

	}//end of sendCustomerEmailAndSms().



	public function _preparesms($smsMessage, $telephone, $frequency_type)
	{
		$telephone=trim($telephone);
		if ($telephone!='' || $telephone!=NULL)
		{
			$smsMessage=strip_tags($smsMessage);

			$tasksModel = new TasksToDo();
			$tasksModel->task = 'sms';
			$tasksModel->status = 'pending';
			$tasksModel->msgbody = $smsMessage;
			$tasksModel->send_to = $telephone;
			$tasksModel->created = time();
			$tasksModel->frequency_type = $frequency_type;
			$tasksModel->save();
		}

	}///end of 	public function _prepareemail($receiver_email_address, $body, $subject, $frequency_type)




	public function _prepareemail($receiver_email_address, $body, $subject, $frequency_type)
	{
		$receiver_email_address=trim($receiver_email_address);
		if ($receiver_email_address!='' || $receiver_email_address!=NULL)
		{
			$tasksModel = new TasksToDo();
			$tasksModel->task = 'email';
			$tasksModel->status = 'pending';
			$tasksModel->msgbody = $body;
			$tasksModel->subject = $subject;
			$tasksModel->send_to = $receiver_email_address;
			$tasksModel->created = time();
			$tasksModel->frequency_type = $frequency_type;
			$tasksModel->save();
		}

	}///end of 	public function _prepareemail($receiver_email_address, $body, $subject, $frequency_type)









	public function sendEmail($reciever_email_address, $body, $subject)
	{
		$email_response = '';
		$email_body = $body;

		$setupModel = Setup::model()->findByPk(1);
		$company_name = $setupModel->company;

		$reciever_email = $reciever_email_address;
		$sender_email = $setupModel->email;

		try {
			//****** SENDING CODE FROM PHPMAILER ****************
			Yii::import('application.vendors.*');
			require_once('mailer/class.phpmailer.php');

			$host = Yii::app()->params['smtp_host'];
			//echo "<br>Host value from main = ".$host;
			$username = Yii::app()->params['smtp_username'];
			//echo "<br>Host value from main = ".$username;
			$password = Yii::app()->params['smtp_password'];
			//echo "<br>Host value from main = ".$password;
			$encry = Yii::app()->params['smtp_encry'];
			//echo "<br>Host value from main = ".$encry;
			$smtp_auth = Yii::app()->params['smtp_auth'];
			//echo "<br>SMTP authentication = ".$smtp_auth;
			$smtp_port = Yii::app()->params['smtp_port'];
			//echo "<br>SMTP authentication = ".$smtp_auth;


			//$sender_email = $username;

			$mail = new PHPMailer();

			$mail->IsSMTP();
			$mail->SMTPAuth = $smtp_auth;
			$mail->Host = $host;  // Specify main and backup server
			$mail->Username = $username;// SMTP username
			$mail->Password = $password;// SMTP password
			$mail->SMTPSecure = $encry;
			$mail->Port = $smtp_port;
			$from_name = $company_name;

			$mail->From = $sender_email;
			$mail->FromName = $from_name;
			$mail->AddAddress($reciever_email);  // Add a recipient
			$mail->AddReplyTo($sender_email);


			$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
			//$mail->AddAttachment('/var/tmp/file.tar.gz');         // Add attachments
			//$mail->AddAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->IsHTML(true);                                  // Set email format to HTML

			$mail->Subject = $subject;
			$mail->Body = $email_body;
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			if (!$mail->Send()) {
				echo "<br>Mailer Error: " . $mail->ErrorInfo . "<hr>";
				echo "<br>Mailer Error: " . $mail->ErrorInfo . "<hr>";
				echo "<br> IsSMTP: " . $mail->IsSMTP();
				echo "<br> SMTPAuth: " . $mail->SMTPAuth;
				echo "<br> Host: " . $mail->Host;  // Specify main and backup server
				echo "<br>Username :" . $mail->Username;// SMTP username
				echo "<br>Password :" . $mail->Password;// SMTP password
				echo "<br>SMTPSecure :" . $mail->SMTPSecure;
				echo "<br>SMTP PORT :" . $mail->Port;

				$email_response = 0;
			} else {
				//echo "<br>Mail sent<hr>";
				$email_response = 1;
			}

		}//end of try.
		catch (Exception $e) {
			echo $e->getMessage();
			$email_response = 0;
		}

		return $email_response;

	}//end of sendEmail().

	public function sendSMS($mobileNumber, $smsMessage)
	{
		//echo "sendSMS func called";

		$smsMessage=strip_tags($smsMessage, '<br>');
		$response = Yii::app()->sms->send(array('to' => $mobileNumber, 'message' => $smsMessage));
		//print_r($response);

		if (isset($response[1])) {
			//echo "<br>error mesg = ".$response[1];
			return $response[1];
		} else
			return true;

	}//end of sendSMS().


	public function performNotification($status_id, $service_id, $frequency_type)
	{
	
	
		//echo "<br>performNotification iscalledpresent";
		$info = '';
		
		$servicecall = Servicecall::model()->findByPk($service_id);
		$setup = Setup::model()->findByPk(1);

		$customer_email = $servicecall->customer->email;
		$customer_mobile = $servicecall->customer->mobile;

		$engineer_email = $servicecall->engineer->contactDetails->email;
		$engineer_mobile = $servicecall->engineer->contactDetails->mobile;

		$warranty_provider_email = $servicecall->contract->mainContactDetails->email;
		$warranty_provider_mobile = $servicecall->contract->mainContactDetails->mobile;


		$company_name = $setup->company;
		$company_email = $setup->email;
		$company_telephone = $setup->telephone;


		$service_reference_number = $servicecall->service_reference_number;
		$customer_name = $servicecall->customer->title . ' ' . $servicecall->customer->last_name;

		$product = $servicecall->product->brand->name . ' ' . $servicecall->product->productType->name;
		$engineer_name = $servicecall->engineer->fullname;
		$job_status = $servicecall->jobStatus->name;
		$warranty_provider_name = $servicecall->contract->name;

		if ($servicecall->enggdiary)
		{
			$date_of_visit = $setup->formatdate($servicecall->enggdiary->visit_start_date);
			$visit_start_time = $setup->formatonlytime($servicecall->enggdiary->visit_start_date);
			//$visit_end_time = $setup->formatdatewithtime($servicecall->enggdiary->visit_end_date);
			$visit_end_time = $setup->formatonlytime($servicecall->enggdiary->visit_end_date);
		}else{
			$visit_start_time = '';
			$visit_end_time = '';
			$date_of_visit ='';
		}


		$variables = array(
			'{CUSTOMER_NAME}' => $customer_name,
			'{SERVICE_REF_NO}' => $service_reference_number,
			'{PRODUCT}' => $product,
			'{JOB_STATUS}' => $job_status,
			'{ENGINEER_NAME}' => $engineer_name,
			'{WARRANTY_PROVIDER}' => $warranty_provider_name,
			'{DATE_OF_VISIT}' => $date_of_visit,
			'{VISIT_START_TIME}' => $visit_start_time,
			'{VISIT_END_TIME}' => $visit_end_time,
			'{YOUR_COMPANY_NAME}' => $company_name,
			'{YOUR_COMPANY_EMAIL}' => $company_email,
			'{YOUR_COMPANY_TELEPHONE}' => $company_telephone,
			'{\n}' => '<br>'
		);

		$subject = 'The status of service call #' . $service_reference_number . ' has been updated to  ' . $job_status;


		$notificationModel = NotificationRules::model()->findAllByAttributes(array('job_status_id' => $status_id));

		if (count($notificationModel) != 0) {


			foreach ($notificationModel as $rule_data) {

				//echo "<h1>I M IN RULE</h1>".$status_id;

				$customerNotificationCode = $rule_data->customer_notification_code;
				$engineerNotificationCode = $rule_data->engineer_notification_code;
				$warrantyProviderNotificationCode = $rule_data->warranty_provider_notification_code;
				$othersNotificationCode = $rule_data->notify_others;

				$email_body = $this->replacevariables($rule_data->email_template, $variables);
				$sms_body = $this->replacevariables($rule_data->sms_template, $variables);

				if ($customerNotificationCode != 0) {
					$response = NotificationRules::model()->notifyByEmailAndSms($customer_email, $customer_mobile, $customerNotificationCode, $email_body, $subject, $sms_body, $frequency_type);
					$info .= NotificationRules::model()->createMessage($response, 'customer');
				}//end of if of CUSTOMER.

				if ($engineerNotificationCode != 0) {
					$response = NotificationRules::model()->notifyByEmailAndSms($engineer_email, $engineer_mobile, $engineerNotificationCode, $email_body, $subject, $sms_body, $frequency_type);
					$info .= NotificationRules::model()->createMessage($response, 'engineer');

				}//end of if of ENGINEER.

				if ($warrantyProviderNotificationCode != 0) {
					$response = NotificationRules::model()->notifyByEmailAndSms($warranty_provider_email, $warranty_provider_mobile, $warrantyProviderNotificationCode, $email_body, $subject, $sms_body, $frequency_type);
					$info .= NotificationRules::model()->createMessage($response, 'warranty');

				}//end of if of WARRANTY PROVIDER.

				if ($othersNotificationCode != 0) {

					$notificationContactModel = NotificationContact::model()->findAllByAttributes(array('notification_rule_id' => $rule_data->id));
					foreach ($notificationContactModel as $contact) {

						$receiver_email_address = $contact->email;
						$telephone = $contact->mobile;

						$name = $contact->person_name;
						$others_body = 'Dear ' . $name . ', Following Email has been sent <hr>' . "<br>" . $email_body;
						$other_notification_code = $contact->notification_code_id;

						$response = NotificationRules::model()->notifyByEmailAndSms($receiver_email_address, $telephone, $other_notification_code, $others_body, $subject, $sms_body,$frequency_type);
						$info .= NotificationRules::model()->createMessage($response, 'others');

					}//end of inner foreach($contact).

				}//end of if of OTHERS.

			}///end of foreach($notificationModel as $data) {


		}//end of count($notificationModel).
		return $info;
	}//end of performNotification().

	public function createMessage($notifyStatusArray, $notifiedTo)
	{


		/* SMS API RETURNS 1 ON SUCCESFUL SMS SENT, OR RESTURNS EMPTY STRING.
		 * EMAIL SUCESSFUL SENT RETURNS 1 ELSE RETURNS 0.
		* */
		$msg = '';
		//echo "<br>SMS response in createMesg func = ".$notifyStatusArray['sms_response'];

		if ($notifyStatusArray['sms_response'] == '1') {
			//echo "<br>!!!!!!!!!!!!!!!!!!!!!!!!!!.............. sms sent sucessfully ......!!!!!!!!!";
			$msg .= "<br><span style='background-color:#C9E0ED; color:#555555;   border-radius:10px 10px 10px 10px; '>SMS has been sent to " . $notifiedTo . ". </span>";
		} elseif ($notifyStatusArray['sms_response'] != 'none') {
			//echo "<br> SMS NOT SENT PROPERLY................!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!";
			$msg = $msg . "<br><div style='background-color:#CD0000; color:white;   border-radius:10px 10px 10px 10px; '>Please check your sms settings or make sure the mobile number " . $notifiedTo . " is valid. &nbsp;&nbsp;&nbsp;Server Response:<i> " . $notifyStatusArray['sms_response'] . ".</i></div>";
		}//end of if(sms_response)

		if ($notifyStatusArray['email_response'] == 1) {
			//echo "<br>Email sent sucessfully ......!!!!!!!!!";
			$msg = $msg . "<br><span style='background-color:#C9E0ED; color:#555555;   border-radius:10px 10px 10px 10px; '>Email has been sent to " . $notifiedTo . ". </span>";
		} elseif ($notifyStatusArray['sms_response'] != 'none') {
			//echo "<br>Error in sending email, check EMAIL settings.";
			$msg = $msg . "<br><span style='background-color:red; color:#CD0000;   border-radius:10px 10px 10px 10px; '>Error in sending email to " . $notifiedTo . ", check EMAIL settings.</span>";
		}
		//echo "<br> Message returned for ".$notifiedTo." = ".$msg;

		//return $msg;
		return "";


	}//end of createMessage().


	public function replacevariables($message, $variables)
	{

		$searchArray = array_keys($variables);
		$replaceArray = array_values($variables);
		return str_replace($searchArray, $replaceArray, $message);

	}///end of	public function replacevariables






	public function runthedailyweeklymonthlynotifications($service_id=null, $jobstatus_id=null)
	{
		$system_msg= "<hr>runtherule called";
		$allrules=NotificationRules::model()->findAllByAttributes(array('active' => '1'));

		foreach ($allrules as $rule)
		{
			$rf=json_decode($rule->frequency);
			//echo $rf->frequency;



			if ($rf->frequency=="daily")
			{
				$system_msg.="<br>**********DAILY JOB IS CALLED******jobstatus_id*****".$jobstatus_id;
				$system_msg.="<br>**********DAILY JOB IS CALLED******service_id*****".$service_id;

				if ($jobstatus_id==$rule->job_status_id)
					$this->performNotification($rule->job_status_id, $service_id, $rf->frequency );

			}///end of if ($rf->frequency=="daily")

			/*
			switch($rf->frequency)
			{
				case "daily":
					$system_msg.="<br>**********DAILY JOB IS CALLED******service_id*****";
					break;
				case "weekly":
					$system_msg.="<br>**********weekly JOB IS CALLED***********";
					break;
				case "monthly":
					$system_msg.="<br>**********monthly JOB IS CALLED***********";
					break;
				default:
					$system_msg.="<br>**********default JOB IS CALLED***********";
					break;
			}
			*/

			$system_msg = $this->checkscheduleandrun($rf, $system_msg, $rule);

		}///end of 	foreach ($allrules as $rule)
		return $system_msg;
	}///end of public function runtheweeklymonthlyrule()




	/**
	 * @param $rf
	 * @param $system_msg
	 * @param $rule
	 * @return array
	 */
	public function checkscheduleandrun($rf, $system_msg, $rule)
	{
		$system_msg .= "Scheduled date is " . $rf->next_run;

		$today_string = date('d-M-Y');
		$system_msg .= "<br> Today is " . $today_string;

		$today_int = strtotime($today_string);
		$scheduled_day_int = strtotime($rf->next_run);

		$system_msg .= "<br> Today INT " . $today_int;
		$system_msg .= "<br> sched INT " . $scheduled_day_int;
		if ($today_int == $scheduled_day_int && $rf->performed == "false") {
			$system_msg .= "Not Performed yet<br>";
			$system_msg .= "<br>RUNNING NOW";

			///Run this rule for all the jobs that are in this status
			$allservicecalls = Servicecall::model()->findAllByAttributes(array('job_status_id' => $rule->job_status_id));
			foreach ($allservicecalls as $s) {
				$system_msg .= "<br>I MA IN FREACH---" . $s->id;
				$this->performNotification($rule->job_status_id, $s->id, $rf->frequency);
			}///end of foreach ($allservicecalls as $s)

			$rf->performed = "true";
			$rf->last_run = date('l, d-M-Y');

		}///end of 	if ($today_string==$scheduled_day_int && $rf->performed=="false")
		else {
			///just check that the performed is set to false and next run date is correct
			$system_msg .= "<br>CAN't RUN TODAY, Setting next Run NOW";

			if ($rf->frequency != "daily") ///we do not want  to run the daily jobs as they are created on the fly

				$rf = $this->setdatafornextrun($rf);

		}


		$rule_performed_update = json_encode($rf);
		$system_msg .= $rule_performed_update;
		NotificationRules::updateByPk($rule->id, array('frequency' => $rule_performed_update));
		return  $system_msg;
	}//end of checkscheduleandrun.





	public function setdatafornextrun($schedule)
	{

		if($schedule->frequency=="daily")
		{
			$next_date=strtotime($schedule->next_run);
		}///edn of 		if($schedule->frequency=="weekly")


		if($schedule->frequency=="weekly")
		{
			$next_date=strtotime('next '.$schedule->day);
			$schedule->next_run=date('l, d-M-Y',$next_date);
		}///edn of 		if($schedule->frequency=="weekly")


		if($schedule->frequency=="monthly")
		{
			///Today's date
			$td=date('d');
			$tm=date('n');
			$ty=date('Y');


			if ($td >= $schedule->day)
			{
				///next month
				if ($tm==12)
				{
					$tm=1;
					$ty=$ty+1;
				}else {
					$tm = $tm + 1;
				}
			}

			$new_date=$schedule->day.'-'.$this->get_month_name($tm).'-'.$ty;
			$next_date=strtotime($new_date);
		}///edn of 		if($schedule->frequency=="weekly")


		$schedule->next_run=date('l, d-M-Y',$next_date);
		//echo "NEXT RUN ".$schedule->next_run;

		$schedule->performed="false";

		return $schedule;
	}///end of 	public function setdatafornextrun($schedule)


	public function get_month_name($month)
	{
		$months = array(
			1   =>  'January',
			2   =>  'February',
			3   =>  'March',
			4   =>  'April',
			5   =>  'May',
			6   =>  'June',
			7   =>  'July',
			8   =>  'August',
			9   =>  'September',
			10  =>  'October',
			11  =>  'November',
			12  =>  'December'
		);

    return $months[$month];
}

}//end of class.