<?php

class GmservicecallsController extends RController
{

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','Servicecallreceivedfromgomobileserver','receivedcalls','gomobileserverurl','getserverurlname'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('admin','sentcalls', 'create','update','servicecallsenttogomobileserver','receiveservicecallfrommobile','receivedcalldetails'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Gmservicecalls;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['GmServicecalls']))
		{
			$model->attributes=$_POST['GmServicecalls'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['GmServicecalls']))
		{
			$model->attributes=$_POST['GmServicecalls'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Gmservicecalls');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Gmservicecalls('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['GmServicecalls']))
			$model->attributes=$_GET['GmServicecalls'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionSentcalls()
	{
		$model=new Gmservicecalls('search_receivedcall');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['GmServicecalls']))
			$model->attributes=$_GET['GmServicecalls'];
		
		$this->render('sentcalls',array(
			'model'=>$model,
		));
	}
	
	
	
	public function actionReceivedcalls()
	{
		$model=new Gmservicecalls('search_receivedcall');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['GmServicecalls']))
			$model->attributes=$_GET['GmServicecalls'];
		
		$this->render('receivedcalls',array(
			'model'=>$model,
		));
	}///end of actionReceivedcalls()
	
	public function actionReceivedcalldetails($id)
	{
		$model=$this->loadModel($id);
		 
		$this->render('receivedcalldetails',array(
			'model'=>$model,
		));
	}
	
	
	public function actionServicecallsenttogomobileserver()
	{
	header("Access-Control-Allow-Origin: *");
	$servicecall_recieved=$_POST['servicecall_ids'];
	//$data='{"unsent_servicecalls":[{"service_reference_number":"127550","message":"Servicecall Cannot be Sent as engineer email is not found on the server. Please contact us at www.rapportsoftware.co.uk"},{"service_reference_number":"127548","message":"Servicecall Cannot be Sent as engineer email is not found on the server. Please contact us at www.rapportsoftware.co.uk"}],"sent_servicecalls":[{"service_reference_number":"127542","message":"Servicecall Sent"}]} ';
	$mydata=json_decode($servicecall_recieved);
	
	foreach ($mydata->unsent_servicecalls as $servicecalls)
		{	
			$unsent_servicecalls_ref_no=$servicecalls->service_reference_number;
			$comments=$servicecalls->message;
			$this->savesentservicecallstatus($unsent_servicecalls_ref_no, '3',$comments);///since 3 is rejected status
		}
		
	foreach ($mydata->sent_servicecalls as $servicecalls)
		{	
			$sent_servicecalls_ref_no=$servicecalls->service_reference_number;
			$comments=$servicecalls->message;
			$this->savesentservicecallstatus($sent_servicecalls_ref_no, '1', $comments);///since 1 is sent status
		}
	}///// end of Servicecallsenttogomobileserver
	
	
	public function actionServicecallreceivedfromgomobileserver()
	{
	header("Access-Control-Allow-Origin: *");
	$servicecall_recieved=$_POST['data'];
	
	 
	//$servicecall_recieved=' [{"gomobile_account_id":"Sudeep","service_reference_number":200001,"work_carried_out":"{\"report_findings\":\"this is the report\",\"workdone\":\"this is the findibr\",\"parts\":[]}","images":"{\"findings\":\"NOIMAGE\",\"product\":\"NOIMAGE\",\"no_access\":\"NOIMAGE\",\"other\":\"NOIMAGE\"}"},{"gomobile_account_id":"Sudeep","service_reference_number":200002,"work_carried_out":"{\"report_findings\":\"Ggg\",\"workdone\":\"Ggf\",\"parts\":[{\"partused\":\"Re\",\"quantity\":\"2\"}]}","images":"{\"findings\":\"NOIMAGE\",\"product\":\"NOIMAGE\",\"no_access\":\"NOIMAGE\",\"other\":\"NOIMAGE\"}"}]';
	//$servicecall_recieved=' [{"gomobile_account_id":"Sudeep","service_reference_number":200002,"work_carried_out":"{\"report_findings\":\"Ggg\",\"workdone\":\"Ggf\",\"parts\":[{\"partused\":\"Re\",\"quantity\":\"2\"}]}","images":"{\"findings\":\"NOIMAGE\",\"product\":\"NOIMAGE\",\"no_access\":\"NOIMAGE\",\"other\":\"NOIMAGE\"}"}]';
	
	$mydata=json_decode($servicecall_recieved);
	//echo json_encode($mydata);
	

	foreach ($mydata as $servicecalls)
	{
			$received_servicecalls_ref_no=$servicecalls->service_reference_number;
			$recieved_data=array();
			
			array_push($recieved_data,$servicecalls->work_carried_out);
			array_push($recieved_data,$servicecalls->images);
 			
 			$recieved_data['work_carried_out']=$servicecalls->work_carried_out;
 			$recieved_data['images']=$servicecalls->images;
 			
 			$recieved_data_json=json_encode($recieved_data);
			
			
			echo '<hr>SERVIC REF NO#'.$received_servicecalls_ref_no;
			echo '<br>WORK CARRIED OUT#'.$servicecalls->work_carried_out;
			echo '<br>IMAGES #'.$servicecalls->images;
			echo $recieved_data_json;
			//echo '<br>COMMENTS ARE :'.print_r($recieved_data).'<hr>';
			
			$this->savesentservicecallstatus($received_servicecalls_ref_no, '5',$recieved_data_json);///since status id 5 is received from mobile status
	}//end of foreach 
	
	
	
	}
	
	
	
	public function actionReceiveservicecallfrommobile()
	{
	 	$this->render('receiveservicecallfrommobile');
	}
	
	
	public function savesentservicecallstatus($service_ref_no, $received_server_status,$comments)
	{
			$servicecall_id=$this->getserviceidbyservicerefrencenumber($service_ref_no);
			$model=new Gmservicecalls;
			$model->servicecall_id=$servicecall_id;
			$model->server_status_id=$received_server_status; 
			$model->service_reference_number=$service_ref_no;
			$model->comments=$comments;
			$model->save();
		
	}

	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return GmServicecalls the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Gmservicecalls::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param GmServicecalls $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='gm-servicecalls-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function getserviceidbyservicerefrencenumber($service_reference_number)
	{
	
		$sc_model=Servicecall::model()->findByAttributes(array('service_reference_number'=>$service_reference_number));
		return $sc_model->id;
		
	}//end of getserviceidbyservicerefrencenumber
	

}
