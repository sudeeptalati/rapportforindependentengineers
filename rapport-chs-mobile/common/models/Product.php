<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $contract_id
 * @property integer $brand_id
 * @property integer $product_type_id
 * @property integer $customer_id
 * @property integer $engineer_id
 * @property string $purchased_from
 * @property string $purchase_date
 * @property string $warranty_date
 * @property string $model_number
 * @property string $serial_number
 * @property string $production_code
 * @property string $enr_number
 * @property string $fnr_number
 * @property integer $discontinued
 * @property integer $warranty_for_months
 * @property double $purchase_price
 * @property string $notes
 * @property integer $created_by_user_id
 * @property string $created
 * @property string $modified
 * @property string $cancelled
 * @property integer $lockcode
 *
 * @property Engineer $engineer
 * @property Customer $customer
 * @property ProductType $productType
 * @property Brand $brand
 * @property Contract $contract
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contract_id', 'brand_id', 'product_type_id', 'customer_id', 'engineer_id', 'discontinued', 'warranty_for_months', 'created_by_user_id', 'lockcode'], 'integer'],
            [['purchased_from', 'model_number', 'serial_number', 'production_code', 'enr_number', 'fnr_number', 'notes'], 'string'],
            [['purchase_date', 'warranty_date', 'created', 'modified', 'cancelled'], 'safe'],
            [['purchase_price'], 'number'],
            //[['engineer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Engineer::className(), 'targetAttribute' => ['engineer_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['product_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductType::className(), 'targetAttribute' => ['product_type_id' => 'id']],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'id']],
            //[['contract_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contract::className(), 'targetAttribute' => ['contract_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'contract_id' => Yii::t('app', 'Contract ID'),
            'brand_id' => Yii::t('app', 'Brand'),
            'product_type_id' => Yii::t('app', 'Product Type'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'engineer_id' => Yii::t('app', 'Engineer ID'),
            'purchased_from' => Yii::t('app', 'Purchased From'),
            'purchase_date' => Yii::t('app', 'Purchase Date'),
            'warranty_date' => Yii::t('app', 'Warranty Date'),
            'model_number' => Yii::t('app', 'Model Number'),
            'serial_number' => Yii::t('app', 'Serial Number'),
            'production_code' => Yii::t('app', 'Production Code'),
            'enr_number' => Yii::t('app', 'Color '),
            'fnr_number' => Yii::t('app', 'Appliance Age (in months)'),
            'discontinued' => Yii::t('app', 'Discontinued'),
            'warranty_for_months' => Yii::t('app', 'Warranty For Months'),
            'purchase_price' => Yii::t('app', 'Purchase Price'),
            'notes' => Yii::t('app', 'Notes'),
            'created_by_user_id' => Yii::t('app', 'Created By User ID'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
            'cancelled' => Yii::t('app', 'Cancelled'),
            'lockcode' => Yii::t('app', 'Lockcode'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEngineer()
    {
        return $this->hasOne(Engineer::className(), ['id' => 'engineer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductType()
    {
        return $this->hasOne(ProductType::className(), ['id' => 'product_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContract()
    {
        return $this->hasOne(Contract::className(), ['id' => 'contract_id']);
    }

    public function getProducttitle()
    {
        return $this->brand->name.' '.$this->productType->name;
    }
}
