<?php

namespace frontend\controllers;

use yii\web\Response;
use common\models\Masteritems;

use Yii;
use common\models\Sparesused;
use common\models\SparesusedSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SparesusedController implements the CRUD actions for Sparesused model.
 */
class SparesusedController extends Controller
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
     * Lists all Sparesused models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SparesusedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sparesused model.
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
     * Creates a new Sparesused model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sparesused();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }



    public function actionRequestsparepart()
    {
        $model = new Sparesused();
        $enggdiary_id= Yii::$app->getRequest()->get('enggdiary_id');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['enggdiary/viewappointment', 'servicecall_id' => $model->servicecall_id, 'enggdiary_id'=>$enggdiary_id, 'spares_block'=>'true' , '#'=>'spares_edit_block']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }

    }



    /**
     * Updates an existing Sparesused model.
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

    public function actionTogglesparesused($id)
    {

        $enggdiary_id= Yii::$app->getRequest()->get('enggdiary_id');

        $model = $this->findModel($id);

        if ($model->used==1)
            $model->used=0;
        else
            $model->used=1;

        if ($model->save()) {
            return $this->redirect(['enggdiary/viewappointment', 'servicecall_id' => $model->servicecall_id, 'enggdiary_id'=>$enggdiary_id, 'spares_block'=>'true' ,'#'=>'spares_edit_block']);
        } else {

            Yii::$app->session->setFlash('warning', 'Try again from here');
            return $this->render('update', [
                'model' => $model,
            ]);
        }

    }///end of toggle spares used


    public function actionSearchmasteritemsrecords()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $keyword= Yii::$app->getRequest()->get('keyword');

        if($keyword)
        {
          echo Masteritems::freesearch($keyword) ;
        }else
        {

        }
    }////end of     public function actionSearchmasteritemsrecords()





    /**
     * Deletes an existing Sparesused model.
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
     * Finds the Sparesused model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sparesused the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sparesused::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
