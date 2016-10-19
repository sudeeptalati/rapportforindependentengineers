<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j324xx_findmyengineer_technician_product_type".
 *
 * @property integer $technician_id
 * @property integer $product_id
 */
class Engineerproducttype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fme_technician_product_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['technician_id', 'product_id'], 'required'],
            [['technician_id', 'product_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'technician_id' => Yii::t('app', 'Technician ID'),
            'product_id' => Yii::t('app', 'Product ID'),
        ];
    }

    /**
     * @inheritdoc
     * @return EngineerproducttypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EngineerproducttypeQuery(get_called_class());
    }




    /**
     * @relations return \yii\db\ActiveQuery
     */
    public function getProductnames()
    {
        return $this->hasOne(Producttype::className(), ['product_id' => 'product_id']);
    }

    public function getEngineer()
    {
        return $this->hasOne(Engineer::className(), ['id' => 'technician_id']);
    }




}
