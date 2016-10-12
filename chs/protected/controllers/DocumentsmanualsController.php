<?php

class DocumentsmanualsController extends RController
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
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
		$model=new Documentsmanuals;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documentsmanuals']))
		{
            $model->attributes=$_POST['Documentsmanuals'];

            $model->upload=CUploadedFile::getInstance($model,'upload');
            if($model->save())
            {
                $model->upload->saveAs('documents_manuals/'.$model->filename);
                $this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['Documentsmanuals']))
		{
			$model->attributes=$_POST['Documentsmanuals'];

            $model->upload=CUploadedFile::getInstance($model,'upload');

            if ($model->upload)
            {
                echo "Uploading";
                $model->upload->saveAs('documents_manuals/'.$model->filename);

            }


            if($model->save())
            {
                $this->redirect(array('view','id'=>$model->id));
            }


        }



		$this->render('update',array(
			'model'=>$model,
		));



	}


	public function actionSearch_docs_manuals()
    {

        $keyword=$_GET['keyword'];

        $docs_manuals=Documentsmanuals::model()->searchbyfilenamemodeldesc($keyword);

        $output=array();
        foreach ($docs_manuals as $d)
        {
            $attach=array();
            $attach['id']=$d->id;
            $attach['name']=$d->name;
            $attach['model_nos']=$d->model_nos;
            $attach['description']=$d->description;
            $attach['filename']=$d->filename;

            array_push($output, $attach);
        }//end of foreach ($sparesresults as $s)

        echo json_encode($output);


    }///end of 	public function actionSearch_docs_manuals()

    public function actionLinkdocumenttoservicecall()
    {
        $service_id=$_POST['service_id'];
        $document_id=$_POST['document_id'];

        /*
        $service_id=$_GET['service_id'];
        $document_id=$_GET['document_id'];
        */

        $service_document=new Servicecallsdocsmanuals;
        $service_document->servicecall_id=$service_id;
        $service_document->document_id=$document_id;

        echo Setup::model()->savemodel($service_document);

    }///end of  public function actionLinkdocumenttoservicecall($service_id,$document_id)

    public function actionDeletedocumentfromservicecall()
    {

        $service_id=$_GET['service_id'];
        $document_id=$_GET['document_id'];


        $servicecall_docs_model=Servicecallsdocsmanuals::model()->findByPk(array('servicecall_id' => $service_id, 'document_id' => $document_id));

        if ($servicecall_docs_model->delete())
            $this->redirect(array('servicecall/view&id='.$service_id.'#attachmentsbox'));
        else
            echo "cannot delete. Pleasec contact support";

    }///end of  public function actionLinkdocumenttoservicecall($service_id,$document_id)









    /**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	/*
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	*/

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Documentsmanuals');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Documentsmanuals('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Documentsmanuals']))
			$model->attributes=$_GET['Documentsmanuals'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Documentsmanuals the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Documentsmanuals::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Documentsmanuals $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='documentsmanuals-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
