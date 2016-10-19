<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fme_technician_autorised_by_manufacturer".
 *
 * @property integer $technician_id
 * @property integer $manufacturer_id
 */
class Engineerauthorisedbrands extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fme_technician_autorised_by_manufacturer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
