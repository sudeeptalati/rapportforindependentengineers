<?php

namespace frontend\controllers;

use common\models\Documentsmanuals;
use common\models\DocumentsmanualsSearch;
use common\models\Servicecallsdocsmanuals;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;


/**
 * DocumentsmanualsController implements the CRUD actions for Documentsmanuals model.
 */
class DocumentsmanualsController extends Controller
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
     * Lists all Documentsmanuals models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocumentsmanualsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Documentsmanuals model.
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
     * Finds the Documentsmanuals model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Documentsmanuals the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Documentsmanuals::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Documentsmanuals model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Documentsmanuals();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * This function is only for validation when form have an action
     * 'enableAjaxValidation' => true,
     * 'validationUrl' =>
     *
     */
    public function actionValidation()
    {
        $model = new Documentsmanuals();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }////end of public function actionQucikupload()

/**
     * Creates a new actionQucikupload model. To quickly upload
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionQuickupload()
    {
        $model = new Documentsmanuals();
        $enggdiary_id= Yii::$app->getRequest()->get('enggdiary_id');
        $servicecall_id = Yii::$app->getRequest()->get('servicecall_id');


        if (Yii::$app->request->isPost && $servicecall_id) {

            $model->load(Yii::$app->request->post());
            $model->uploadfile = UploadedFile::getInstance($model, 'uploadfile');


            if ($model->save()) {
                // file is uploaded successfully

                if ($model->upload()) {
                    $service_doc = new Servicecallsdocsmanuals();
                    $service_doc->servicecall_id = $servicecall_id;
                    $service_doc->document_id = $model->id;
                    if ($service_doc->save()) {
                        Yii::$app->session->setFlash('successfully', 'File Attached');
                        return $this->redirect(['enggdiary/viewappointment', 'servicecall_id' => $servicecall_id, 'enggdiary_id'=>$enggdiary_id, 'docs_manuals_block'=>'true']);

                    }////end of if ($service_doc->save())

                    else {
                        Yii::$app->session->setFlash('error', 'File was uploaded and saved but could not link to servicecall please try again');
                        return $this->redirect(['enggdiary/viewappointment', 'servicecall_id' => $servicecall_id]);
                    }
                }/////end of if ($model->save()) {
                else {
                    Yii::$app->session->setFlash('error', 'Cannot Upload file. If it happens again please contact support');
                    return $this->redirect(['enggdiary/viewappointment', 'servicecall_id' => $servicecall_id]);
                }

            }////end of if  if ($model->upload()) {
            else {

                var_dump($model->getErrors());
                Yii::$app->session->setFlash('error', 'Could not save file . Please try again');
                //return $this->redirect(['enggdiary/viewappointment', 'servicecall_id' => $servicecall_id]);
            }


        }////end of if  if (Yii::$app->request->isPost) {
        else {
            Yii::$app->session->setFlash('error', 'You are trying wrong way to upload! If happens again please contact support');
            return $this->redirect(['site/calendar']);
        }


    }///endo public function actionUploadsignature()


    public function actionUploadsignature()
    {
        $model = new Documentsmanuals();
        $servicecall_id = Yii::$app->getRequest()->get('servicecall_id');
        $enggdiary_id= Yii::$app->getRequest()->get('enggdiary_id');


        if (Yii::$app->request->isPost && $servicecall_id) {

            $model->load(Yii::$app->request->post());
            //$model->uploadfile = UploadedFile::getInstance($model, 'base64string');

            $data_uri = $model->base64string;

            $encoded_image = explode(",", $data_uri)[1];
            $decoded_image = base64_decode($encoded_image);


            $file = Yii::$app->params['documents_upload_location_absolute_path'] . $model->filename;

            //echo $file;
            //file_put_contents () function returns the number of bytes
            // that were written to the file, or FALSE on failure.

            if (file_put_contents($file, $decoded_image)) {

                if ($model->save()) {

                    $service_doc = new Servicecallsdocsmanuals();
                    $service_doc->servicecall_id = $servicecall_id;
                    $service_doc->document_id = $model->id;
                    if ($service_doc->save()) {
                        Yii::$app->session->setFlash('successfully', 'File Attached');
                        return $this->redirect(['enggdiary/viewappointment', 'servicecall_id' => $servicecall_id, 'enggdiary_id'=>$enggdiary_id, 'email_servicecall_block'=>'true' ,'#'=>'email_servicecall_block']);

                    }////end of if ($service_doc->save())

                    else {
                        Yii::$app->session->setFlash('error', 'File was uploaded and saved but could not link to servicecall please try again');
                        return $this->redirect(['enggdiary/viewappointment', 'servicecall_id' => $servicecall_id,'enggdiary_id'=>$enggdiary_id,]);
                    }
                }
                else
                {
                    Yii::$app->session->setFlash('error', 'File was uploaded but data could not be saved. Please try again');
                    return $this->redirect(['enggdiary/viewappointment', 'servicecall_id' => $servicecall_id,'enggdiary_id'=>$enggdiary_id,]);

                }
            }
            else {
                Yii::$app->session->setFlash('error', 'Cannot Upload file. If it happens again please contact support');
                return $this->redirect(['enggdiary/viewappointment', 'servicecall_id' => $servicecall_id,'enggdiary_id'=>$enggdiary_id,]);
            }

        }
        else{
            Yii::$app->session->setFlash('error', 'You are trying wrong way to upload! If happens again please contact support');
            return $this->redirect(['site/calendar']);
        }


    }////public function actionUploadsignature()


    /**
     * Updates an existing Documentsmanuals model.
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

    /**
     * Deletes an existing Documentsmanuals model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
}
