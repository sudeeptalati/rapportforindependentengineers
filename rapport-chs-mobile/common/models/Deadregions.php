<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fme_dead".
 *
 * @property integer $dead_id
 * @property string $postcode
 * @property string $brand_name
 * @property string $product_type_name
 * @property double $latitude
 * @property double $longitude
 * @property string $postcode_s
 * @property string $postcode_e
 * @property integer $product_id
 * @property integer $manufacturer_id
 * @property integer $resolved
 * @property string $ip_address
 * @property string $date_logged
 */
class Deadregions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fme_dead';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['postcode', 'brand_name' ,'product_type_name', 'latitude', 'longitude', 'postcode_s', 'product_id', 'manufacturer_id', 'ip_address'], 'required'],
            [['postcode', 'brand_name' ,'product_type_name'], 'string'],
            [['latitude', 'longitude'], 'number'],
            [['product_id', 'manufacturer_id', 'resolved'], 'integer'],
            [['date_logged', 'brand_name' ,'product_type_name'], 'safe'],
            [['postcode_s'], 'string', 'max' => 4],
            [['postcode_e'], 'string', 'max' => 3],
            [['ip_address'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dead_id' => Yii::t('app', 'Dead ID'),
            'postcode' => Yii::t('app', 'Postcode'),

            'brand_name' => Yii::t('app', 'Brand'),
            'product_type_name' => Yii::t('app', 'Appliance'),

            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'postcode_s' => Yii::t('app', 'Postcode S'),
            'postcode_e' => Yii::t('app', 'Postcode E'),
            'product_id' => Yii::t('app', 'Product ID'),
            'manufacturer_id' => Yii::t('app', 'Manufacturer ID'),
            'resolved' => Yii::t('app', 'Resolved'),
            'ip_address' => Yii::t('app', 'Ip Address'),
            'date_logged' => Yii::t('app', 'Date Logged'),
        ];
    }


    public function getProducttype()
    {
        return $this->hasOne(Producttype::className(), ['product_id' => 'product_id']);
    }

    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['manufacturer_id' => 'manufacturer_id']);
    }




}
