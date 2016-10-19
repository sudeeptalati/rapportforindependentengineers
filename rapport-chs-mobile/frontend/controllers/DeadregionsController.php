<?php

namespace frontend\controllers;

use Yii;
use common\models\Deadregions;
use common\models\DeadregionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\filters\AccessControl;

/**
 * DeadregionsController implements the CRUD actions for Deadregions model.
 */
class DeadregionsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['deletebrand','addallbrands','deleteproduct','addallproducts', 'index','update','view'],
                'only' => ['index'],
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
     * Lists all Deadregions models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DeadregionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     *
     * List all dead regions in Json
     * @return Json
     */

    public function actionPullallinjson()
    {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $dead_regions=Deadregions::find()->where('latitude != :latitude and longitude != :longitude', ['latitude'=>0, 'longitude'=>0])->asArray()->all();
        echo json_encode($dead_regions);


    }


    /**
     * Displays a single Deadregions model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        /*
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
        */
    }

    /**
     * Creates a new Deadregions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        /*
        $model = new Deadregions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->dead_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        */
    }

    /**
     * Updates an existing Deadregions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        /*
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->dead_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        */
    }

    /**
     * Deletes an existing Deadregions model.
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
     * Finds the Deadregions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Deadregions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Deadregions::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
