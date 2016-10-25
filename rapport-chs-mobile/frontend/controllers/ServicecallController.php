<?php

namespace frontend\controllers;

use common\models\Emailservicecall;
use Yii;
use common\models\Servicecall;
use common\models\ServicecallSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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



    public function actionUpdateeditservicecallonly()
    {
        $servicecall_id= Yii::$app->getRequest()->get('servicecall_id');
        $model = $this->findModel($servicecall_id);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Service Details Updated');
            return $this->redirect(['enggdiary/viewappointment', 'servicecall_id' => $servicecall_id, 'servicecall_block'=>'true', '#'=>'servicecallbox']);
        } else {

            Yii::$app->session->setFlash('warning', 'Try again from here');
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    public function actionJobfinished()
    {
        $servicecall_id= Yii::$app->getRequest()->get('servicecall_id');
        $job_status_id= Yii::$app->getRequest()->get('job_status_id');
        $model = $this->findModel($servicecall_id);

        $model->job_status_id=$job_status_id; ////This is the system status for Job completed by the engineer

        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Service call marked as finished');
            return $this->redirect(['enggdiary/showappointmentsfordate']);
        } else {

            Yii::$app->session->setFlash('warning', 'There was some problem in updating the job. Please try again');
            return $this->render('update', [
                'model' => $model,
            ]);
        }


    }/////end of public function actionJobfinished()




    public function actionEmailservicecall()
    {
        echo "Emailing to ";

        $email_servicecall=new Emailservicecall();


        if ($email_servicecall->load(Yii::$app->request->post()))
        {
            echo $email_servicecall->email;
            echo $email_servicecall->servicecall_id;

            $jobsheet_url=Yii::$app->params['main_system_url'].'?r=servicecall/preview&id='.$email_servicecall->servicecall_id;

            $from_email='mailtest.test10@gmail.com';
            $recipient_emails=$email_servicecall->email;
            $subject="Job Sheet";
            $plaintext="Please find the jobsheet";
            $mail_html_content='<h1>This is HTML. Please find job sheet</h1>';

            return Yii::$app->mailer->compose()
                ->setFrom($from_email)
                ->setTo($recipient_emails)
                ->setSubject($subject)
                ->setTextBody($plaintext)
                ->setHtmlBody($mail_html_content)
                ->attach($jobsheet_url)
                ->send();


        }else
        {
            Yii::$app->session->setFlash('error', 'Error in finding emails.');
            return $this->redirect(['enggdiary/showappointmentsfordate']);
        }

        //getting pdfs

        ///sendin


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
