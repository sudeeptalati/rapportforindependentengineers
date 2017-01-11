<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "enggdiary".
 *
 * @property integer $id
 * @property integer $engineer_id
 * @property string $visit_start_date
 * @property string $visit_end_date
 * @property integer $slots
 * @property integer $servicecall_id
 * @property integer $user_id
 * @property string $created
 * @property string $modified
 * @property integer $status
 * @property string $notes
 * @property string $duration_of_call
 *
 */
class Enggdiary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'enggdiary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['duration_of_call', 'engineer_id', 'slots', 'servicecall_id', 'user_id', 'status'], 'integer'],
            [['visit_start_date', 'visit_end_date', 'created', 'modified'], 'safe'],
            [['notes'], 'string'],
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicecall()
    {
        return $this->hasOne(Servicecall::className(), ['id' => 'servicecall_id']);
    }




    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'engineer_id' => Yii::t('app', 'Engineer ID'),
            'visit_start_date' => Yii::t('app', 'Visit Start Date'),
            'visit_end_date' => Yii::t('app', 'Visit End Date'),
            'slots' => Yii::t('app', 'Slots'),
            'servicecall_id' => Yii::t('app', 'Servicecall ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
            'status' => Yii::t('app', 'Status'),
            'notes' => Yii::t('app', 'Notes'),
            'duration_of_call'=>Yii::t('app', 'Duration of Call')
        ];
    }



    public static function loadallappointmentsbyservicecall_id($service_id)
    {
        return self::findAll(['servicecall_id'=>$service_id]);
    }









}
