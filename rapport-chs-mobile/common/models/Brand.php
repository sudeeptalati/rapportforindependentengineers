<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $name
 * @property string $information
 * @property integer $active
 * @property integer $created_by_user_id
 * @property string $created
 * @property string $modified
 * @property string $inactivated
 * @property integer $server_brand_id
 *
 * @property Product[] $products
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'information'], 'string'],
            [['active', 'created_by_user_id', 'server_brand_id'], 'integer'],
            [['created', 'modified', 'inactivated'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'information' => Yii::t('app', 'Information'),
            'active' => Yii::t('app', 'Active'),
            'created_by_user_id' => Yii::t('app', 'Created By User ID'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
            'inactivated' => Yii::t('app', 'Inactivated'),
            'server_brand_id' => Yii::t('app', 'Server Brand ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['brand_id' => 'id']);
    }
}
