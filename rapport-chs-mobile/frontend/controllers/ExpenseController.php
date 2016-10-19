<?php

namespace frontend\controllers;

use frontend\models\Dayexpense;
use Yii;
use frontend\models\Expense;
use frontend\models\ExpenseSearch;
use frontend\models\Userroles;
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
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['claimexpense', 'index','create','update','view', 'delete'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // everything else is denied
                ],
            ],
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
        $loggedinuser = Yii::$app->user->identity;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'loggedinuser' => $loggedinuser,
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




    public function actionClaimexpense($id)
    {
        echo 'expense id '.$id;

        $model=$this->findModel($id);
        $model->status_id='20';
        $model->submission_date=date('Y-m-d H:i:s');

        if ($model->save())
        {
            echo "Successfully Saved";
            //Now emails will be sent

            if ($this->sendemailnotifications($id))
            {
                Yii::$app->session->setFlash('success', 'Expense Claim successfully submitted');
                return $this->redirect(['view', 'id' => $model->id]);
            }else
            {
                Yii::$app->session->setFlash('error', 'Error in Sending email');
                return $this->redirect(['view', 'id' => $model->id]);

            }

        }
        else
            throw new NotFoundHttpException('Could Claim expenses. Please contact support.');

        ///Status will be changed

        //Email will be sent to user & admin

    }//end of  public function actionClaimexpense()


    protected function sendemailnotifications($id)
    {
        $model=$this->findModel($id);

        $mailhtmlcontent ="<strong>Hello Expense Admin</strong> <br>";
        $mailhtmlcontent .="<p>Please review the following expense.</p>";
        $mailhtmlcontent .="<p><button>Approve</button><button>Reject</button></p>";

        $mailhtmlcontent .=   $this->renderPartial('view', [
            'model' =>$model,
        ]);

        $from_email=Yii::$app->user->identity->email;
        $plaintext=strip_tags($mailhtmlcontent);
        $subject="TESTING PLEASE IGNORE. Expense Request ".$model->expense_title." Ref. No#".$model->reference_number;

        ///get admin users email address
        $adminusers= Userroles::find()->where(['role_type_id' => '1', ])->all(); ///We will get email of admin users

        $recipient_emails=array();
        array_push($recipient_emails,$from_email );

        foreach ($adminusers as $au) {
            array_push($recipient_emails, $au->email);
        }


        $emailsent= Yii::$app->mailer->compose()
            ->setFrom($from_email)
            ->setTo($recipient_emails)
            ->setSubject($subject)
            ->setTextBody($plaintext)
            ->setHtmlBody($mailhtmlcontent)
            ->send();


        return $emailsent;

        //var_dump($recipient_emails);

    }///end of     protected function sendemailnotifications($id)


}
