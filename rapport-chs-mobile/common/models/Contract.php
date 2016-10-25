<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contract".
 *
 * @property integer $id
 * @property integer $contract_type_id
 * @property string $name
 * @property integer $main_contact_details_id
 * @property string $vat_reg_number
 * @property string $notes
 * @property integer $active
 * @property integer $inactivated_by_user_id
 * @property string $inactivated_on
 * @property integer $created_by_user_id
 * @property string $created
 * @property string $modified
 * @property string $management_contact_details
 * @property string $spares_contact_details
 * @property string $accounts_contact_details
 * @property string $technical_contact_details
 * @property string $short_name
 * @property integer $labour_warranty_months_duration
 * @property integer $parts_warranty_months_duration
 *
 * @property Product[] $products
 */
class Contract extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contract';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contract_type_id', 'main_contact_details_id', 'active', 'inactivated_by_user_id', 'created_by_user_id', 'labour_warranty_months_duration', 'parts_warranty_months_duration'], 'integer'],
            [['name', 'vat_reg_number', 'notes', 'management_contact_details', 'spares_contact_details', 'accounts_contact_details', 'technical_contact_details', 'short_name'], 'string'],
            [['inactivated_on', 'created', 'modified'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'contract_type_id' => Yii::t('app', 'Contract Type ID'),
            'name' => Yii::t('app', 'Name'),
            'main_contact_details_id' => Yii::t('app', 'Main Contact Details ID'),
            'vat_reg_number' => Yii::t('app', 'Vat Reg Number'),
            'notes' => Yii::t('app', 'Notes'),
            'active' => Yii::t('app', 'Active'),
            'inactivated_by_user_id' => Yii::t('app', 'Inactivated By User ID'),
            'inactivated_on' => Yii::t('app', 'Inactivated On'),
            'created_by_user_id' => Yii::t('app', 'Created By User ID'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
            'management_contact_details' => Yii::t('app', 'Management Contact Details'),
            'spares_contact_details' => Yii::t('app', 'Spares Contact Details'),
            'accounts_contact_details' => Yii::t('app', 'Accounts Contact Details'),
            'technical_contact_details' => Yii::t('app', 'Technical Contact Details'),
            'short_name' => Yii::t('app', 'Short Name'),
            'labour_warranty_months_duration' => Yii::t('app', 'Labour Warranty Months Duration'),
            'parts_warranty_months_duration' => Yii::t('app', 'Parts Warranty Months Duration'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['contract_id' => 'id']);
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContracttype()
    {
        return $this->hasOne(Contracttype::className(), ['contract_type_id' => 'id']);
    }




}
