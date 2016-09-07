<?php

class EnggdiaryController extends RController
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('AppointIcalender','diary','currentAppointments','viewFullDiary', 'BookingAppointment','ICalLink', 'test', 'ChangeEngineerOnly','admin','create','update','ChangeEngineer','ChangeAppointment','dailysummary','WeeklyReport'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','displayDiary'),
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
		
		$service_id=$_GET['id'];
		$engg_id=$_GET['engineer_id'];
		//echo "THIS IS SELECTED :".$engg_id;
		//echo "<hr>SEVRICE CALL ID :".$service_id;
		$model=new Enggdiary;
		$model->servicecall_id=$service_id;
		$model->engineer_id=$engg_id;
		$model->status='3';//STATUS OF APPOINTMENT(VISIT START DATE).
		//echo "THIS IS SELECTED :".$model->engineer_id;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Enggdiary']))
		{
			$model->attributes=$_POST['Enggdiary'];
			
			if($model->save())
			{
				$seviceQueryModel=Servicecall::model()->findByPk($service_id);
				$serviceModel=Servicecall::model()->updateByPk($seviceQueryModel->id,
													array('job_status_id'=>'3')	
													);
				$service_id=$model->servicecall_id;
        		$engg_id=$model->engineer_id;
	        	
				$baseUrl=Yii::app()->request->baseUrl;
				//$this->redirect($baseUrl.'/servicecall/'.$service_id);
				$this->redirect(array('/servicecall/view','id'=>$service_id ));
			}
			
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

		if(isset($_POST['Enggdiary']))
		{
			$model->attributes=$_POST['Enggdiary'];
			$updatemodel=Enggdiary::model()->updateByPk($id,
    				array('notes'=>$_POST['appointment_notes'])
    				);
			
			//if($model->save())
			if($updatemodel==1)
				$this->redirect(array('/Servicecall/view','id'=>$model->servicecall->id));
			else
				echo var_dump($model->getErrors());
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
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Enggdiary');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Enggdiary('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Enggdiary']))
			$model->attributes=$_GET['Enggdiary'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Enggdiary::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='enggdiary-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}//end of ajax.
	

	
	
	public function actionChangeEngineer()
	{
		
		$model=new Enggdiary();
		
		if (isset($_GET['engineer_id']))
		{
			
		$model->engineer_id=$_GET['engineer_id'];
		//echo "ENGINEER ID IN CONTROLLER :".$model->engineer_id;
		}
	    
		
		if(isset($_POST['Enggdiary']))
    	{
        $model->attributes=$_POST['Enggdiary'];
        //echo "I M INSIDE AND id is ".$model->engineer_id;
        if ($model->servicecall_id)
        	{
//			if($model->save())
//			{
	        	$service_id=$model->servicecall_id;
	        	$engg_id=$model->engineer_id;
	        	
				$baseUrl=Yii::app()->request->baseUrl;
				//$this->redirect($baseUrl.'/enggdiary/create/'.$service_id.'?engineer_id='.$engg_id);
				$this->redirect(array('/enggdiary/create/', 'id'=>$service_id, 'engineer_id'=>$engg_id));
        	}	

    	}//
    
		$this->render('changeEngineer',array(
			'model'=>$model,
		));

//    	$this->render('viewFullDiary', array('model'=>$model,'engg_id'=>'0'));
    	
    
	}
///end of function change engineer	
	
	public function actionChangeAppointment()
	{
		$service_id=$_GET['serviceId'];
	    $engg_id=$_GET['engineerId'];
	    
	//    echo "<br>EWNDF I D ID ".$engg_id;
		$diaryid=$_GET['enggdiary_id'];
		//echo "diary id in controller :".$diaryid;		
	    $model=$this->loadModel($diaryid);
	    $model->engineer_id=$engg_id;
	    //$model->servicecall_id=$service_id;
	    $model->id=$diaryid;
	    
	    if(isset($_POST['Enggdiary']))
	    {
			$model->attributes=$_POST['Enggdiary'];

		//	echo 'SERVICE CLAL ID ids '.$model->servicecall_id;
			$servicecall_model=Servicecall::model()->findByPk($model->servicecall_id);
			$current_engg_diary_id=$servicecall_model->engg_diary_id;
			//echo '<br>Current Fdiary id :'.$current_engg_diary_id;
		    Enggdiary::model()->updateByPk($current_engg_diary_id,
														array(
														'status'=>'11',//change old appointment status to Cancelled.
														)
												);
	    												
	    	/*CREATING A NEW MODEL HERE */												
	    	$newmodel=new Enggdiary;
			$newmodel->servicecall_id=$model->servicecall_id;;
//				echo '<br> NEW ENGG ID ID '.$model->engineer_id;
			$newmodel->engineer_id=$model->engineer_id;;
		
			$newmodel->attributes=$_POST['Enggdiary'];
			$newmodel->status='3';
			
			//echo 'SERVICECALL ID'.$newmodel->servicecall_id;
			
			if ($newmodel->save())
			{
		 		$new_diary_model=Enggdiary::model()->findByAttributes(
		 																array(
		 																'servicecall_id'=>$newmodel->servicecall_id,
		 																'status'=>3,
		 																)
		 															);				
			//	echo 'Engg Diary Id'. $new_diary_model->id;		 															
		    	Servicecall::model()->updateByPk($new_diary_model->servicecall_id,
														array(
														'engg_diary_id'=>$new_diary_model->id,
														'engineer_id'=>$new_diary_model->engineer_id,														
														)
												);
				
				
				
				
				$baseUrl=Yii::app()->request->baseUrl;
				//$this->redirect($baseUrl.'/servicecall/'.$new_diary_model->servicecall_id);
				$this->redirect(array('/servicecall/view', 'id'=>$new_diary_model->servicecall_id));
			
			
			}//end of diary model save.
			else 
			{
				//echo "Engg Diary nor saved";
			}
			
	    }//end of if(isset());
	    $this->render('changeAppointment',array('model'=>$model));
	}//END OF CHANGE appointment.
	
	public function actionChangeEngineerOnly($id)
	{
		
		$model=$this->loadModel($id);
		
		if(isset($_POST['Enggdiary']))
    	{
			$model->attributes=$_POST['Enggdiary'];
			if ($model->servicecall_id)
        	{
				$service_id=$model->servicecall_id;	
				$engg_id=$model->engineer_id;
//
//      	 	 echo "I M INSIDE AND id is ".$model->engineer_id;
//      	   	 echo "<br> SERVICE ".$model->servicecall_id;
//      	     echo "Diary ID".$id;
      	           	
				$baseUrl=Yii::app()->request->baseUrl;
				//$this->redirect($baseUrl.'/enggdiary/ChangeAppointment/?serviceId='.$service_id.'&engineerId='.$engg_id.'&enggdiary_id='.$id);
				$this->redirect(array('/enggdiary/ChangeAppointment/', 'serviceId'=>$service_id, 'engineerId'=>$engg_id, 'enggdiary_id'=>$id));
				
			}//end of if ($model).	

    	}//end of if isset.
	
	}//end of function change engineer Only
	
	public function actionWeeklyReport()
	{
		$model=new Enggdiary('view');
		
		if(isset($_POST['Enggdiary']))
		{
		 	$model->attributes=$_POST['Enggdiary'];
		    if($model->validate())
		    {
		    	// form inputs are valid, do something here
		        return;
		     }
		}
		$this->render('weeklyReport',array('model'=>$model));
	}//end of function weeklyReport().
	
	
	public function actionDailysummary()
	{
		
		$engineer_id=$_GET['engineer_id'];
		$summary_date=$_GET['summary_date'];
	
	
		//$enggid=$model->engineer_id;
		//$_POST['$enggid'];
		$this->renderPartial('dailysummary',array( 'engineer_id'=>$engineer_id , 'summary_date'=>$summary_date));
	
		
	}
	
	
	
	public function actionViewFullDiary()
	{
		$model=new Enggdiary('search');
		$engg_id = '';
		
		
		if (isset($_GET['engg_id']))
		{
			$engg_id=$_GET['engg_id'];
			//echo "CAUGT ISSET ".$engg_id;
		}
		else 
		{
			//echo "value not found";
			$engg_id = '0';
			
		}//END OF ELSE, i.e, no id is got from dropdown in viewFullDiary view.
		
		
		
		/*
		
		if(isset($_GET['engineer_id']) && isset($_GET['id']) )
		{
			echo "ENGG_ID IN VIEWFULLCAL CONTR = ". $_GET['engineer_id']."<br>";
			$engg_id = $_GET['engineer_id'];
			echo "SERVICECALL ID IN VIEWFULLCAL CONTR = ". $_GET['id']."<br>";
			$service_id  = $_GET['id'];
			
		}//end of if of isset of engineer_id and service_id got from servicecall controller.
		*/
		
		
		
		if(isset($_GET['Enggdiary']))
		{
			//echo "Value is present<br>";
			$model->attributes=$_GET['Enggdiary'];
			//echo "Value in  is = ".$model->engineer_id;
			$engg_id = $model->engineer_id;
			//echo "CAUGT ".$engg_id;
			
			
		}//end of if engg_id is present got from dropdown in viewFullDiary view.
				
		//echo "<hr>Engg id in enggController = ".$engg_id;
		 
		 
		
		$this->render('viewFullDiary',array('model'=>$model,
											'engg_id'=>$engg_id
									));
		
		
	}////end of actionViewFullDiary
	
	public function actionBookingAppointment()
	{
	    //$model=new Enggdiary('view');
	    
	    $model=new Enggdiary('search');
		$engg_id = '';
		
		if(isset($_GET['engineer_id']) && isset($_GET['id']) )
		{
			//echo "ENGG_ID IN VIEWFULLCAL CONTR = ". $_GET['engineer_id']."<br>";
			$engg_id = $_GET['engineer_id'];
			//echo "SERVICECALL ID IN VIEWFULLCAL CONTR = ". $_GET['id']."<br>";
			$service_id  = $_GET['id'];

		}//end of if of isset of engineer_id and service_id got from servicecall controller.
		
		/****** PROCESSING ENGG_ID GOT FROM DROPDOWN ********/
		if(isset($_GET['Enggdiary']))
		{
			//echo "Value is present<br>";
			$model->attributes=$_GET['Enggdiary'];
			//echo "Value in  is = ".$model->engineer_id;
			$engg_id = $model->engineer_id;
			//echo "CAUGT ".$engg_id;
		}//end of if engg_id is present got from dropdown in viewFullDiary view.
		/****** END OF PROCESSING ENGG_ID GOT FROM DROPDOWN ********/
		
	    $this->render('bookingAppointment',array('model'=>$model,
	    										 'engg_id'=>$engg_id,
												 'service_id'=>$service_id
	    							));
	}//end of bookingAppointment().
	
	
	public function actionCurrentAppointments()
	{
		//echo "here";
		$model=new Enggdiary('search');
		$engg_id = 0;
		
	    if(isset($_GET['Enggdiary']))
	    {
	    	$model->attributes = $_GET['Enggdiary'];
	    	$engg_id = $model->engineer_id;
	    	//echo "<hr>engineer id from dropdown of current Appointments form = ".$engg_id."<hr>";	
	    }
//	    else
//	    {
//	    	$engg_id = 0;
//	    }

//	 	if(isset($_POST['FutureAppointments']))
//	    {
//	    	$model->attributes = $_POST['FutureAppointments'];
//	    	$engg_id = $_POST['engineer_id'];
//	    	
//	    	echo "<hr>engineer id got from dropdown of current Appointments form = ".$engg_id."<hr>";	
//	    }
	    
	    $this->render('currentAppointments',
	    					array(
	    					'model'=>$model,'future_engg_id'=>$engg_id
	    			));
	}//end of CurrentAppointments().
	
	
	public function actionAppointIcalender($service_id)
	{
		$model=new Enggdiary('view');
		
	
		// uncomment the following code to enable ajax-based validation
		/*
		 if(isset($_POST['ajax']) && $_POST['ajax']==='enggdiary-appointIcalender-form')
		 {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		*/
	
		/*
		if(isset($_POST['Enggdiary']))
		{
			$model->attributes=$_POST['Enggdiary'];
			if($model->validate())
			{
				// form inputs are valid, do something here
				return;
			}
		}
		*/
		$this->render('appointIcalender',array('model'=>$model));
	}//end of AppointIcalender.


	public function actionDiary()
	{
		header('Access-Control-Allow-Origin: *');
		$this->render('diary');
		//$this->redirect(array('enggdiary/bookingAppointment&id='.$_GET['id'].'&engineer_id='.$_GET['engineer_id']));
	}


	public function actionFindnextappointmentofengg()
	{
		header('Access-Control-Allow-Origin: *');
		$this->render('find_next_appointment_of_engg');
		//$this->redirect(array('enggdiary/bookingAppointment&id='.$_GET['id'].'&engineer_id='.$_GET['engineer_id']));
	}



	public function actionFindnextappointmentfromallengg()
	{
		header('Access-Control-Allow-Origin: *');
		$this->render('find_next_appointment_from_all_engg');
		//$this->redirect(array('enggdiary/bookingAppointment&id='.$_GET['id'].'&engineer_id='.$_GET['engineer_id']));
	}


	public function actionManuallyappointmentbooking
	()
	{
		header('Access-Control-Allow-Origin: *');
		$this->render('manuallyappointmentbooking');
		//$this->redirect(array('enggdiary/bookingAppointment&id='.$_GET['id'].'&engineer_id='.$_GET['engineer_id']));
	}



	
	public function actionMarkrouteongooglemap()
	{
		$engineer_id=$_GET['engineer_id'];
		$route_date_string=$_GET['route_date'];
	 	$route_date_time=strtotime($route_date_string);
 		$route_map_results=Enggdiary::model()->fetchDiaryDetails($engineer_id ,$route_date_time);	
		$this->renderPartial('markrouteongooglemap',array( 'engineer_id'=>$engineer_id , 'route_map_results'=>$route_map_results));
	
 
	}///end of actionMarkrouteongooglemap
	
	
	public function actionOptimiseroutebygoogleapi()
	{
		$engineer_id=$_GET['engineer_id'];
		$route_date_string=$_GET['route_date'];
		$planroute=$_GET['planroute'];
		$route_date_time=strtotime($route_date_string);
		$route_map_results=Enggdiary::model()->fetchDiaryDetails($engineer_id ,$route_date_time);	
		$this->render('optimiseroutebygoogleapi',array( 'engineer_id'=>$engineer_id , 'route_map_results'=>$route_map_results, 'planroute'=>$planroute));
	}///end of  actionOptimiseroutebygoogleapi	
	
	
	public function actionGetdiaryofengineerfordate()
	{
		$date=strtotime($_GET['date']);
		$engineer_id=$_GET['engineer_id'];
		//var_dump($_GET);
 		$allevents=Enggdiary::model()->fetchDiaryDetails($engineer_id,$date);
 		
 		$mydata=array();
		$diary_events_array = array();
 		
 		foreach ($allevents as $data)
 		{
 			$start_date= date("Y-m-d H:i",$data->visit_start_date);
 			$end_date= date("Y-m-d H:i",$data->visit_end_date);
 			$customer_name=$data->servicecall->customer->fullname;
			$customer_postcode=$data->servicecall->customer->postcode;
		    $engineer_name = $data->engineer->fullname;
 					
 			$diary_events_array['id'] = $data->id;///id of the engg diary
		    $diary_events_array['service_id'] = $data->servicecall_id;
			$diary_events_array['title'] = "".$customer_name." ".$customer_postcode."\n ".$engineer_name."\n".$data->notes; ///** HERE WE WIL DISPLAY custtomer name and postcode
			$diary_events_array['start'] = $start_date;
			$diary_events_array['end'] = $end_date;
		    //$diary_events_array['url'] = Yii::app()->baseUrl."/index.php?r=Servicecall/view&id=".$data->servicecall_id;
		    $diary_events_array['allDay'] = false ;
		    $diary_events_array['textColor'] = "white" ;
		    array_push($mydata,$diary_events_array);
 		
 		}//end of foreach ($allevents as $e)
 		echo json_encode($mydata);
 
 	}///end of public function actionGetdiaryofengineerfordate()
	
	
	
	public function actionUpdatescheduleindiary()
	{
		if(isset($_GET['diary_id'])){

			$diary_id=$_GET['diary_id'];
			$visit_start_date=strtotime($_GET['visit_start_date']);
			$visit_end_date=strtotime($_GET['visit_end_date']);
		 
			$update_diary=Enggdiary::model()->updateappointmentduration($diary_id, $visit_start_date , $visit_end_date);
		
			if ($update_diary==1)
				echo 'Updated';
			else
				echo 'Error in updating';
		}//end of 		if(isset($_POST['diary_id'])){
		else
		echo 'Bad Request';
	}///end pf 	public function actionUpdatescheduleindiary()


	public function actionFindenggavailableondate()
	{
		$json_output = array();

		$totalnoofcallsperday = Enggdiary::model()->getTotalnoofcallsperday();

		//echo "actionFindenggavailableondate";
/*
                echo $_POST['postcodes'];
                echo $_POST['dates'];
*/
        $postcodes='["William Harris Way, Colchester, Essex CO2 8WJ, UK","Landermere Rd, Thorpe-le-Soken, Clacton-on-Sea, Essex CO16 0LL, UK","Melbourne Rd, Clacton-on-Sea, Essex CO15 3HY, UK","Audries Estate, Walton on the Naze, Essex CO14 8TB, UK","Artillery Dr, Harwich, Essex CO12 5FG, UK","St John\'s Rd, Clacton-on-Sea, Essex CO16 8BS, UK","Church Ln, Brantham, Manningtree, Suffolk CO11 1QD, UK","Great Bentley, Colchester, Essex CO7 8PP, UK","Manor Rd, Wivenhoe, Colchester, Essex CO7 9LL, UK"]';
        $dates='["5-7-2016","6-7-2016","7-7-2016"]';
		//echo $postcodes;
		//echo $dates;


		if (isset($_POST['postcodes']) && isset($_POST['dates'])) {

			$postcodes = $_POST['postcodes'];
			$dates = $_POST['dates'];

//		if (1==1){

			$json_output['status']="OK";
			$json_output['status_message']="Finding Data";

			$postcodes_json = json_decode($postcodes);
			$dates_json = json_decode($dates);
			$datesofenggavailability=array();

			$date_array = array();
			foreach ($dates_json as $d) {
				$d;

				$date_array['date'] = $d;

				$day_start = $d . " 00:00:00";
				$day_end = $d . " 23:59:59";

				$day_start_int = strtotime($day_start);
				$day_end_int = strtotime($day_end);


				$date_array['day_start_int'] = $day_start_int;
				$date_array['day_end_int'] = $day_end_int;

				$date_array['day_start_str'] = date('d-F-Y H:i:s', $day_start_int);
				$date_array['day_end_str'] = date('d-F-Y H:i:s', $day_end_int);

				$available_engineers_array = array();


				////finding servicecalls on this date

				$servicealls = Enggdiary::model()->getcompletediaryforday($day_start_int, $day_end_int);

				$servicecalls_array = array();
				//echo '<hr>'.$date_array['day_start_str'];

				foreach ($servicealls as $s) {
					$s_array = array();

					$s_array['diary_id'] = $s->id;

					$s_array['service_id'] = $s->servicecall_id;
					$s_array['customer'] = $s->servicecall->customer->fullname;
					$s_array['postcode'] = $s->servicecall->customer->postcode;
					$s_array['engineer'] = $s->engineer->fullname;

					$s_array['visit_start_date'] = date('d-F-Y H:i:s', $s->visit_start_date);
					$s_array['visit_end_date'] = date('d-F-Y H:i:s', $s->visit_end_date);

					//echo '<br>+-------------------SERVICEPC------'.$s->servicecall_id;

					foreach ($postcodes_json as $p) {
						//echo '<br>'.$p;
						$supplied_postcode_no_space = preg_replace('/\s+/', '', $p);
						$s_array['supplied_formatted_postcode'] = $supplied_postcode_no_space;

						$servicecall_postcode_no_space = preg_replace('/\s+/', '', $s->servicecall->customer->postcode);
						$s_array['customer_formatted_postcode'] = $servicecall_postcode_no_space;

						if (strpos($supplied_postcode_no_space, $servicecall_postcode_no_space) !== false) {



							$available_engg = array();
							$available_engg['engineer_id'] = $s->engineer->id;
							$available_engg['engineer_name'] = $s->engineer->fullname;

							if ($this->checkifenggarray_donot_containsengg($available_engineers_array, $available_engg))
							{
								//var_dump($available_engg);
								array_push($available_engineers_array, $available_engg);

							}
						}


					}////end of foreach ($postcodes_json as $p)


					array_push($servicecalls_array, $s_array);
				}///end of 		foreach ($servicealls as $s) {


				//because we are considering only 3 dates if any day has no engg, we can fill it up
				if (count($available_engineers_array) == 0) {
					$active_engg = Engineer::model()->getallactiveengineerfordiaryandrouteplanning();
					foreach ($active_engg as $e) {
						$available_engg = array();
						$available_engg['engineer_id'] = $e->id;
						$available_engg['engineer_name'] = $e->fullname;
						array_push($available_engineers_array, $available_engg);
					}///end of foreach ($active_engg as $e)
				}


				$date_array['available_enggs'] = $available_engineers_array;

				$date_array['servicecalls'] = $servicecalls_array;
				//echo json_encode($s_array);

				array_push($datesofenggavailability, $date_array);

			}//end of foreach


			$json_output['result']=$datesofenggavailability;

		}//end of if (isset($_POST['postcodes']) && isset($_POST['dates']))
		else
		{
			$json_output['status']="INVALID_REQUEST";
			$json_output['status_message']="Input Data Missing";

		}

		echo json_encode($json_output);


	}///end of public function actionFindenggavailableondate()


	public function checkifenggarray_donot_containsengg($engg_array, $engg)
	{


		foreach ($engg_array as $item) {

			if ($engg['engineer_id']==$item['engineer_id'])
				return false;
		 }

		return true;
	}//end of public function checkifarraycontainsengg()



	public function actionEditnotesonly()
	{

		if (isset($_POST['Enggdiary'])) {

			$id= $_POST['Enggdiary']['id'];
			$notes = $_POST['Enggdiary']['notes'];

			$r = Enggdiary::model()->updateByPk($id,array('notes' =>$notes));

			////Update engineer by PK
			if ($r == 1) {
				$new_diary_model=$this->loadModel($id);
				//redirect
				$this->redirect(array('/servicecall/view', 'id'=>$new_diary_model->servicecall_id, '#'=>'enginnerbox'));
			} else
				echo 'cannot update Job Status in servicecall. Please contact support';

		}
		$this->renderPartial('editnotesonly');
	}//end of ChangeEngineerOnly.


	public function actionCancelappointment()
	{

		$diary_id=$_GET['diary_id'];
		$model=$this->loadModel($diary_id);

		$c=Enggdiary::model()->cancelappointment($model);


		if ($c==1)
			$this->redirect(array('/servicecall/view', 'id'=>$model->servicecall_id, '#'=>'enginnerbox'));
		 else
			echo 'cannot update Job Status in servicecall. Please contact support';


	}/////enf of 	public function actionCancelappointment()


}//end of class.
