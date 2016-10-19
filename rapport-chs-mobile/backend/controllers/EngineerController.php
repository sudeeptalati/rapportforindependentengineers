<?php

namespace backend\controllers;

use common\models\Brand;
use common\models\Producttype;
use common\models\Engineerauthorisedbrands;
use common\models\Engineerproducttype;
use common\models\Engineerbrands;

use common\models\Handyfunctions;
use common\models\User;
use Yii;
use common\models\Engineer;
use backend\models\EngineerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        $searchModel = new EngineerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Engineer model.
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
     * Creates a new Engineer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Engineer();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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

        return $this->redirect(['view', 'id' => $engineer_id, '#'=>'appliances-view' ]);

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

        return $this->redirect(['view', 'id' => $engineer_id, '#'=>'appliances-view' ]);

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

        return $this->redirect(['view', 'id' => $engineer_id, '#' => 'brands-view']);


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

        return $this->redirect(['view', 'id' => $engineer_id, '#' => 'brands-view']);

    }

    public function actionDeletepostcode()
    {
        $engineer_id = Yii::$app->getRequest()->get('engineer_id');
        $postcode_id = Yii::$app->getRequest()->get('postcode_id');
        echo $postcode_id;
        echo $engineer_id;
        $engg_postcode = $this->findEngineerPostcode($postcode_id, $engineer_id);


        echo $engg_postcode->postcodename->postcode_s;
        echo $engg_postcode->engineer->name;
        $engg_postcode->delete();

        return $this->redirect(['view', 'id' => $engineer_id, '#' => 'postcodes-we-cover']);

    }///end of     protected function findEngineerProducttype()


    public function actionAddselectedpostcodes()
    {
        $engineer_id = Yii::$app->getRequest()->get('engineer_id');

        if (Yii::$app->request->post()) {

            $postcodes = Yii::$app->getRequest()->post('postcodes');

            if (count($postcodes) > 0) {
                foreach ($postcodes as $p_id) {
                    $engg_postcode = new Engineerpostcodes();
                    $engg_postcode->technician_id = $engineer_id;
                    $engg_postcode->postcode_id = $p_id;
                    $engg_postcode->save();
                }
            }

        }///end of if (Yii::$app->request->post())) {

        return $this->redirect(['view', 'id' => $engineer_id, '#' => 'postcodes-we-cover']);

    }///end of     protected function findEngineerPostcode()



    public function actionAddselectedauthorisedbrand()
    {
        $engineer_id = Yii::$app->getRequest()->get('engineer_id');

        if (Yii::$app->request->post()) {

            $authorised_brand_id = Yii::$app->getRequest()->post('authorised_brand_id');


            echo $authorised_brand_id;


            $engg_postcode = new Engineerauthorisedbrands();
            $engg_postcode->technician_id = $engineer_id;
            $engg_postcode->manufacturer_id = $authorised_brand_id;
            $engg_postcode->save();


        }///end of if (Yii::$app->request->post())) {

        return $this->redirect(['view', 'id' => $engineer_id, '#' => 'authorised-brands-view']);

    }///end of     protected function findEngineerPostcode()






    public function actionAddallauthorisedbrands()
    {
        $engineer_id = Yii::$app->getRequest()->get('engineer_id');

        $all_authorised_brands = Brand::find()->all();

        foreach ($all_authorised_brands as $ab) {
            $engg_authorised_brand = Engineerauthorisedbrands::find()->where(['manufacturer_id' => $ab->manufacturer_id, 'technician_id' => $engineer_id,])->one();
            if (empty($engg_authorised_brand)) {
                $engg_authorised_brand = new Engineerauthorisedbrands();
                $engg_authorised_brand->technician_id = $engineer_id;
                $engg_authorised_brand->manufacturer_id = $ab->manufacturer_id;
                $engg_authorised_brand->save();
            }
        }

        return $this->redirect(['view', 'id' => $engineer_id, '#'=>'appliance-view' ]);

    }////end of     public function actionAddallauthorisedbrands()


    public function actionDeleteauthorisedbrand()
    {
        $authorised_brand_id = Yii::$app->getRequest()->get('authorised_brand_id');
        $engineer_id = Yii::$app->getRequest()->get('engineer_id');
        echo $authorised_brand_id;
        echo $engineer_id;
        $engg_brand = $this->findEngineerAuthorisedBrand($authorised_brand_id, $engineer_id);
        echo $engg_brand->brandname->manufacturer;
        echo $engg_brand->engineer->name;
        $engg_brand->delete();

        return $this->redirect(['view', 'id' => $engineer_id, '#' => 'brands-view']);


    }///end of function  public function actionDeletepostcode()








    public function actionUpdateengineeremailforlogin()
    {
        if (Yii::$app->request->post()) {

            $engineer_id = Yii::$app->getRequest()->post('engineer_id');
            $user_id = Yii::$app->getRequest()->post('user_id');
            $engineer_email = Yii::$app->getRequest()->post('engineer_email');

            ///First update user
            $user=User::findIdentity($user_id);
            $user->email=$engineer_email;
            $user->username=$engineer_email;
            $user->save();

            //echo Handyfunctions::print_model_errors($user);

            $engineer=Engineer::findIdentity($engineer_id);
            $engineer->email=$engineer_email;
            $engineer->user_id=$user->id;

            $engineer->save();


            ///Now update engineer
            if ($user->save() && $engineer->save())
                return $this->redirect(['view', 'id' => $engineer_id, '#' => 'user-div']);
            else
            {
                echo "<hr>There was some error in saving engineer email. Please contact support";
                echo '<hr>'.Handyfunctions::print_model_errors($engineer);
                echo '<hr>'.Handyfunctions::print_model_errors($user);
            }

        }else
        {
            echo "<hr>This is invalid request. Please contact support";
        }


    }/////end of public function actionUpdateengineeremailforlogin()

    /////Authorised Brands




    public function actionCreateuserforengineer()
    {
        $engineer_id = Yii::$app->getRequest()->get('engineer_id');
        $engineer=Engineer::findIdentity($engineer_id);

        if($engineer)
        {
            $user=new User();
            $user->email=$engineer->email;
            $user->username=$engineer->email;
            $user->save();


            $engineer=Engineer::findIdentity($engineer_id);
            $engineer->email=$user->email;
            $engineer->user_id=$user->id;
            $engineer->save();


            if ($user->save() && $engineer->save())
                return $this->redirect(['view', 'id' => $engineer_id, '#' => 'user-div']);
            else
            {
                echo "<hr>There was some error in saving engineer email. Please contact support";
                echo '<hr>'.Handyfunctions::print_model_errors($engineer);
                echo '<hr>'.Handyfunctions::print_model_errors($user);
            }

        }else
        {
            echo "<hr>Cannot find Engineer. Please contact support";
        }



    }////end of public function actionCreateuserforengineer()


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


    protected function findEngineerAuthorisedBrand($authorised_brand_id, $engineer_id)
    {
        if (($engg_authorised_brand = Engineerauthorisedbrands::find()->where(['manufacturer_id' => $authorised_brand_id, 'technician_id' => $engineer_id,])->one()) !== null) {
            return $engg_authorised_brand;
        } else {
            throw new NotFoundHttpException('The requested Brand with engineer does not exist.');
        }

    }////end of    public function findEngineerBrand()

}

