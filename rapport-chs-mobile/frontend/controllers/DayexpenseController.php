<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Dayexpense;
use frontend\models\DayexpenseSearch;
use frontend\models\Expense;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DayexpenseController implements the CRUD actions for Dayexpense model.
 */
class DayexpenseController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['showdayexpensesbyexpenseid', 'index','create','update','view', 'delete'],
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
     * Lists all day expense for specific expense id
     */
    public function actionShowdayexpensesbyexpenseid()
    {
        return $this->render('showdayexpensesbyexpenseid');
    }



    /**
     * Lists all Dayexpense models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DayexpenseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Dayexpense model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model=$this->findModel($id);
        $expenseModel=$this->findExpenseModel($model->expense_id);

        return $this->render('view', [
            'model' => $model,'expenseModel' => $expenseModel,
        ]);
    }

    /**
     * Creates a new Dayexpense model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $expense_id=$_GET['expense_id'];

        $expenseModel=$this->findExpenseModel($expense_id);

        $model = new Dayexpense();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            echo 'saved';
            return $this->redirect(['expense/view', 'id' => $expenseModel->id]);
        } else {
            return $this->render('create', [
                'model' => $model, 'expenseModel' => $expenseModel, 'expense_id' => $expense_id,
            ]);
        }
    }

    /**
     * Updates an existing Dayexpense model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model=$this->findModel($id);
        $expenseModel=$this->findExpenseModel($model->expense_id);




        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            echo "updaetd";
            return $this->redirect(['expense/view', 'id' => $expenseModel->id]);
        } else {
            return $this->render('update', [
                'model' => $model, 'expenseModel' => $expenseModel, 'expense_id' => $model->expense_id,
            ]);
        }

    }

    /**
     * Deletes an existing Dayexpense model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $model->delete();
        $model->addtotalexpensestomainform();
        return $this->redirect(['expense/view', 'id' => $model->expense_id]);
        //return $this->redirect(['index']);
    }

    /**
     * Finds the Dayexpense model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dayexpense the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dayexpense::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    protected function findExpenseModel($expense_id)
    {
        if (($expenseModel = Expense::findOne($expense_id)) !== null) {
            return $expenseModel ;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
