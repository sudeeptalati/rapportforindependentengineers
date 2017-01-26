<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 19/01/2017
 * Time: 11:05
 */
namespace backend\controllers;

use common\models\Handyfunctions;
use Yii;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use yii\web\Response;


class ApiController extends ActiveController
{
    public $modelClass = 'common\models\Servicecall';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];




    public $user_password;

    public function init()
    {
        parent::init();
        \Yii::$app->user->enableSession = false;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
        ];


        /*
        $behaviors['bootstrap'] = [
            'class' => \yii\filters\ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
**/

        return $behaviors;

    }

    public function fields()
    {
        $fields = parent::fields();
        $fields[] = 'servicecall';

        return $fields;
    }





}//end of class ServicecallapiController

