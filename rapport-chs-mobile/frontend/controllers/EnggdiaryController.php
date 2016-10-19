<?php

namespace frontend\controllers;

use common\models\Servicecall;
use Yii;
use common\models\Enggdiary;
use common\models\EnggdiarySearch;
use common\models\Handyfunctions;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;




/**
 * EnggdiaryController implements the CRUD actions for Enggdiary model.
 */
class EnggdiaryController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['showappointmentsfordate', 'viewappointment'],
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
     * Lists all Enggdiary models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EnggdiarySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionShowappointmentsfordate()
    {

        $date = Yii::$app->request->get('date');
        $engineer_id = Yii::$app->user->identity->engineer_id;

        if ($date)
        {
            $date_string=$date;
        }else
        {
            $date_string=Handyfunctions::get_todays_date_string();
        }

        $weekday=Handyfunctions::get_weekday_string(strtotime($date_string));

        $searchModel = new EnggdiarySearch();
        $appointments = $searchModel->appointmentsfordateforengineer($engineer_id, $date_string);

        return $this->render('showappointmentsfordate', [
            'appointments' => $appointments,
            'date_string' => $date_string,
            'weekday' => $weekday,

        ]);
    }

    public function actionViewappointment()
    {

        $servicecall_id = Yii::$app->request->get('servicecall_id');
        $engineer_id = Yii::$app->user->identity->engineer_id;

        if (!$servicecall_id )
        {
            return $this->redirect(['/site']);
        }

        $servicecall=Servicecall::findOne($servicecall_id);

        return $this->render('viewappointment', [
            'servicecall' => $servicecall,
        ]);

    }



    /**
     * Displays a single Enggdiary model.
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
     * Creates a new Enggdiary model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Enggdiary();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Enggdiary model.
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
     * Deletes an existing Enggdiary model.
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
     * Finds the Enggdiary model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Enggdiary the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Enggdiary::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
