<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 01/11/2016
 * Time: 15:02
 * */

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Changeservicecallstatus form
 */
class Changeservicecallstatus extends Model
{

    public $servicecall_id;
    public $job_status_id;





    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['job_status_id', 'servicecall_id'], 'required'],
            [['job_status_id', 'servicecall_id'], 'integer'],


        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'servicecall_id' => Yii::t('app', 'Servicecall Id '),
            'job_status_id' => Yii::t('app', 'Job Status'),

        ];
    }


}
