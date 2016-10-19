<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $information
 * @property integer $created_by_user_id
 * @property string $created
 * @property string $modified
 * @property integer $server_product_type_id
 * @property integer $active
 * @property string $inactivated
 *
 * @property Product[] $products
 */
class ProductType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'information'], 'string'],
            [['created_by_user_id', 'server_product_type_id', 'active'], 'integer'],
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
            'created_by_user_id' => Yii::t('app', 'Created By User ID'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
            'server_product_type_id' => Yii::t('app', 'Server Product Type ID'),
            'active' => Yii::t('app', 'Active'),
            'inactivated' => Yii::t('app', 'Inactivated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['product_type_id' => 'id']);
    }
}
