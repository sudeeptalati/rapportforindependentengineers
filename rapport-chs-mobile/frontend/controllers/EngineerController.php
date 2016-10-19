<?php

namespace frontend\controllers;

use common\models\Brand;
use common\models\Engineer;
use common\models\Engineerbrands;
use common\models\Engineerproducttype;

use common\models\Producttype;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\filters\AccessControl;


/**
 * EngineerController implements the CRUD actions for Engineer model.
 */
class EngineerController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['webintegration','deletebrand','addallbrands','deleteproduct','addallproducts', 'index','update','view'],
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
     * Lists all Engineer models.
     * @return mixed
     */
    public function actionIndex()
    {

        if (Yii::$app->user->isGuest)
        {
            Yii::$app->session->setFlash('success', 'Please login first.');
            return $this->goHome();

        }else
        {
            $user_id=Yii::$app->user->identity->id;
            $model=Engineer::findIdentityByUserId($user_id);
            if ($model)
                return $this->redirect(['view', 'id' => $model->id]);
            else
            {
                Yii::$app->session->setFlash('error', 'There was some problem in finding your account. Please contact support   .');
                return $this->goHome();
            }

        }

    }

    /**
     * Displays a single Engineer model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $user_id=Yii::$app->user->identity->id;
        $model=Engineer::findIdentityByUserId($user_id);


        if ($user_id===$model->user_id)
        {
            return $this->render('view', [
                'model' => $model,
            ]);

        }else
        {
            Yii::$app->session->setFlash('error', 'Don\'t try to be CREEPY.  You are not allowed to view this. Just focus on yourself');
            return $this->goHome();
        }
    }


    public function actionWebintegration()
    {
        $user_id=Yii::$app->user->identity->id;
        $model=Engineer::findIdentityByUserId($user_id);

        if ($model)
        {
            if ($user_id===$model->user_id)
            {
                return $this->render('webintegration', [
                    'model' => $model,
                ]);

            }else
            {
                Yii::$app->session->setFlash('error', 'Don\'t try to be CREEPY.  You are not allowed to view this. Just focus on yourself');
                return $this->goHome();
            }

        }else{
            Yii::$app->session->setFlash('error', 'There was some problem in finding your account. Please contact support   .');
            return $this->goHome();

        }

    }///end of  public function actionWebintegration($id)



    /**
     * Creates a new Engineer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        /*
        $model = new Engineer();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        */
    }

    /**
     * Updates an existing Engineer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $user_id=Yii::$app->user->identity->id;
        if ($user_id===$model->user_id)
        {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }

        }else
        {
            Yii::$app->session->setFlash('error', 'Don\'t try to be CREEPY.  You are not allowed to view this. Just focus on yourself');
            return $this->goHome();
        }
    }

    /**
     * Deletes an existing Engineer model.
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





    public function actionDeleteproduct()
    {
        $product_id = Yii::$app->getRequest()->get('product_id');
        $engineer_id = Yii::$app->getRequest()->get('engineer_id');
        echo $product_id;
        echo $engineer_id;
        $engg_product = $this->findEngineerProducttype($product_id, $engineer_id);
        echo $engg_product->productnames->product_type;
        echo $engg_product->engineer->name;
        $engg_product->delete();

        return $this->redirect(['view', 'id' => $engineer_id, '#'=>'appliance-we-repair' ]);

    }////end of     public function actionAddallproducts()

    public function actionAddallproducts()
    {
        $engineer_id = Yii::$app->getRequest()->get('engineer_id');

        $all_product_types = Producttype::find()->all();

        foreach ($all_product_types as $pt) {
            $engg_product = Engineerproducttype::find()->where(['product_id' => $pt->product_id, 'technician_id' => $engineer_id,])->one();
            if (empty($engg_product)) {
                $engg_product_type = new Engineerproducttype();
                $engg_product_type->technician_id = $engineer_id;
                $engg_product_type->product_id = $pt->product_id;
                $engg_product_type->save();
            }
        }

        return $this->redirect(['view', 'id' => $engineer_id, '#'=>'appliance-we-repair' ]);

    }////end of     public function actionAddallproducts()

    public function actionDeletebrand()
    {
        $brand_id = Yii::$app->getRequest()->get('brand_id');
        $engineer_id = Yii::$app->getRequest()->get('engineer_id');
        echo $brand_id;
        echo $engineer_id;
        $engg_brand = $this->findEngineerBrand($brand_id, $engineer_id);
        echo $engg_brand->brandname->manufacturer;
        echo $engg_brand->engineer->name;
        $engg_brand->delete();

        return $this->redirect(['view', 'id' => $engineer_id, '#' => 'brands-we-repair']);


    }///end of function  public function actionDeletepostcode()


    public function actionAddallbrands()
    {
        $engineer_id = Yii::$app->getRequest()->get('engineer_id');

        $all_brands = Brand::find()->all();

        foreach ($all_brands as $b) {
            $engg_brand = Engineerbrands::find()->where(['manufacturer_id' => $b->manufacturer_id, 'technician_id' => $engineer_id,])->one();
            if (empty($engg_brand)) {
                $engg_product_type = new Engineerbrands();
                $engg_product_type->technician_id = $engineer_id;
                $engg_product_type->manufacturer_id = $b->manufacturer_id;
                $engg_product_type->save();
            }
        }

        return $this->redirect(['view', 'id' => $engineer_id, '#' => 'brands-we-repair']);

    }





    /**
     * Finds the Engineer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Engineer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Engineer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findEngineerPostcode($postcode_id, $engineer_id)
    {
        if (($engg_postcode = Engineerpostcodes::find()->where(['postcode_id' => $postcode_id, 'technician_id' => $engineer_id,])->one()) !== null) {
            return $engg_postcode;
        } else {
            throw new NotFoundHttpException('The requested Brand with engineer does not exist.');
        }

    }///end of     protected function findEngineerBrand()

    protected function findEngineerBrand($brand_id, $engineer_id)
    {
        if (($engg_brand = Engineerbrands::find()->where(['manufacturer_id' => $brand_id, 'technician_id' => $engineer_id,])->one()) !== null) {
            return $engg_brand;
        } else {
            throw new NotFoundHttpException('The requested Brand with engineer does not exist.');
        }

    }////end of    public function findEngineerBrand()


    protected function findEngineerProducttype($product_id, $engineer_id)
    {
        if (($engg_product = Engineerproducttype::find()->where(['product_id' => $product_id, 'technician_id' => $engineer_id,])->one()) !== null) {
            return $engg_product;
        } else {
            throw new NotFoundHttpException('The requested Product Type with Engineer page does not exist.');
        }

    }///end of function  public function findEngineerProducttype()



}
