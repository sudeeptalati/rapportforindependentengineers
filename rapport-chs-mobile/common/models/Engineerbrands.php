<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j324xx_findmyengineer_technician_manufacturer".
 *
 * @property integer $technician_id
 * @property integer $manufacturer_id
 */
class Engineerbrands extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fme_technician_manufacturer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['technician_id', 'manufacturer_id'], 'required'],
            [['technician_id', 'manufacturer_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'technician_id' => Yii::t('app', 'Technician ID'),
            'manufacturer_id' => Yii::t('app', 'Manufacturer ID'),
        ];
    }

    /**
     * @inheritdoc
     * @return EngineerbrandsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EngineerbrandsQuery(get_called_class());
    }


    /**
     * @relations return \yii\db\ActiveQuery
     */
    public function getBrandname()
    {
        return $this->hasOne(Brand::className(), ['manufacturer_id' => 'manufacturer_id']);
    }


    public function getEngineer()
    {
        return $this->hasOne(Engineer::className(), ['id' => 'technician_id']);
    }


}
