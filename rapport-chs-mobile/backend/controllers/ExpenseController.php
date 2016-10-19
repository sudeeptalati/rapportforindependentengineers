<?php

namespace backend\controllers;

use Yii;
use backend\models\Expense;
use backend\models\ExpenseSearch;
use backend\models\Userroles;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExpenseController implements the CRUD actions for Expense model.
 */
class ExpenseController extends Controller
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
     * Lists all Expense models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExpenseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Expense model.
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
     * Creates a new Expense model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Expense();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Expense model.
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
     * Approves the claim
     */

    public function actionApprove($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {


            if ($this->sendapproveemailnotifications($id))
            {
                Yii::$app->session->setFlash('success', 'Claim Approved');
                return $this->redirect(['view', 'id' => $model->id]);
            }else {
                Yii::$app->session->setFlash('error', 'Error in Sending email');
                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {
            Yii::$app->session->setFlash('Error', 'Claim Not Approved. Please contact Support');
            return $this->render('view', [
                'model' => $model,
            ]);
        }
    }



    /**
     * Rejects  the claim
     */

    public function actionReject($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {


            if ($this->sendrejectemailnotifications($id))
            {
                Yii::$app->session->setFlash('error', 'Claim Rejected');
                return $this->redirect(['view', 'id' => $model->id]);
            }else {
                Yii::$app->session->setFlash('error', 'Error in Sending email');
                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {
            Yii::$app->session->setFlash('Error', 'Claim Not Approved. Please contact Support');
            return $this->render('view', [
                'model' => $model,
            ]);
        }
    }





    /**
     * Deletes an existing Expense model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Expense model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Expense the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Expense::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



    protected function sendapproveemailnotifications($id)
    {
        $model=$this->findModel($id);

        $mailhtmlcontent ="<strong>Hello </strong> <br>";
        $mailhtmlcontent .="<p>The following expense claim has been <strong style='color: green'>approved</strong>. Please debit the funds into the user account.</p>";

        $mailhtmlcontent .=   $this->renderPartial('view', [
            'model' =>$model,
        ]);

        $from_email=Yii::$app->user->identity->email;
        $plaintext=strip_tags($mailhtmlcontent);
        $subject="TESTING PLEASE IGNORE. Expense Approved".$model->expense_title." Ref. No#".$model->reference_number;

        ///get admin users email address
        $adminusers= Userroles::find()->where(['role_type_id' => '1', ])->all(); ///We will get email of admin users
        $fianance_department= Userroles::find()->where(['role_type_id' => '2', ])->all(); ///We will get email of admin users

        $recipient_emails=array();
        array_push($recipient_emails,$from_email );
        array_push($recipient_emails,$model->user->email );

        foreach ($adminusers as $au) {
            array_push($recipient_emails, $au->email);
        }

        foreach ($fianance_department as $fu) {
            array_push($recipient_emails, $fu->email);
        }

        return $this->_sendmail($from_email, $recipient_emails, $subject, $plaintext, $mailhtmlcontent);

    }






    protected function sendrejectemailnotifications($id)
    {
        $model=$this->findModel($id);

        $mailhtmlcontent ="<strong>Hello </strong> <br>";
        $mailhtmlcontent .="<p>The following expense claim has been <strong style='color: red>'>rejected</strong>. Please see the notes for further details.</p>";

        $mailhtmlcontent .=   $this->renderPartial('view', [
            'model' =>$model,
        ]);

        $from_email=Yii::$app->user->identity->email;
        $plaintext=strip_tags($mailhtmlcontent);
        $subject="TESTING PLEASE IGNORE. Expense Rejected".$model->expense_title." Ref. No#".$model->reference_number;

        ///get admin users email address
        $adminusers= Userroles::find()->where(['role_type_id' => '1', ])->all(); ///We will get email of admin users

        $recipient_emails=array();
        array_push($recipient_emails,$from_email );
        array_push($recipient_emails,$model->user->email );

        foreach ($adminusers as $au) {
            array_push($recipient_emails, $au->email);
        }


        return $this->_sendmail($from_email, $recipient_emails, $subject, $plaintext, $mailhtmlcontent);
    }

    /**
     * @param $from_email
     * @param $recipient_emails
     * @param $subject
     * @param $plaintext
     * @param $mailhtmlcontent
     * @return bool
     */
    protected function _sendmail($from_email, $recipient_emails, $subject, $plaintext, $mailhtmlcontent)
    {
        $emailsent = Yii::$app->mailer->compose()
            ->setFrom($from_email)
            ->setTo($recipient_emails)
            ->setSubject($subject)
            ->setTextBody($plaintext)
            ->setHtmlBody($mailhtmlcontent)
            ->send();


        return $emailsent;
    }///end of     protected function sendemailnotifications($id)





}
