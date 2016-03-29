<?php

class DefaultController extends RController
{

	public function filters() {
        return array(
            'rights', // perform access control for CRUD operations
        );
    }
	
	
	public function actionIndex()
	{
		$this->render('index');
	}///end of index
	
	public function actionPostdatatoserver()
	{
	$this->render('postdata');
	}///end of PostDatatoServer
	
	public function actionJobstatusselectionofservicecall()
	{
	$this->render('jobstatusselectionofservicecall');
	}///end of Jobstatusselectionofservicecall
	
	public function actionDatabyappointmentdate()
	{
		$this->render('databyappointmentdate');
	}///end of Databyappointmentdate
	
	public function actionGetaccountid()
	{
		$gomobile_account_id=Gmservicecalls::model()->getaccountid();
		$this->render('accountsetup_view', array('gomobile_account_id'=>$gomobile_account_id));
	}////end of Getaccountid
	
	public function actionSetaccountid()
	{
		if (isset($_POST['gomobile_account_id']))
		{
			Gmservicecalls::model()->setaccountid($_POST['gomobile_account_id']); 
			$this->redirect(array('/gomobile/default/getaccountid'));
		}
		$gomobile_account_id=Gmservicecalls::model()->getaccountid(); 
		$this->render('setaccountid', array('gomobile_account_id'=>$gomobile_account_id));
	}////end of Getaccountid
	
	public function actionGetserverurl()
	{
		$gomobile_server_url=Gmservicecalls::model()->getserverurl();
		$this->render('serverurl_view', array('server_url'=>$gomobile_server_url));
	}////end of actionGetserverurl
	
	
	public function actionSendsingleservicecalltoserver()
	{
	
		$this->renderPartial('sendsingleservicecalltoserver');
	
	
	}//end of public function actionSendsingleservicecalltoserver() ///created by SUDEEP TALATI
		
		
}////end of class