<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j324xx_findmyengineer_postcodes_technician".
 *
 * @property integer $postcode_id
 * @property integer $technician_id
 */
class Engineerpostcodes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fme_postcodes_technician';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['postcode_id', 'technician_id'], 'required'],
            [['postcode_id', 'technician_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'postcode_id' => Yii::t('app', 'Postcode ID'),
            'technician_id' => Yii::t('app', 'Technician ID'),
        ];
    }

    /**
     * @inheritdoc
     * @return EngineerpostcodesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EngineerpostcodesQuery(get_called_class());
    }



    /**
     * @relations return \yii\db\ActiveQuery
     */
    public function getPostcodename()
    {
        return $this->hasOne(Postcodes::className(), ['postcode_id' => 'postcode_id']);
    }



    public function getEngineer()
    {
        return $this->hasOne(Engineer::className(), ['id' => 'technician_id']);
    }

}
