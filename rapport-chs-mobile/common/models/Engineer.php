<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "engineer".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property integer $active
 * @property string $company
 * @property string $vat_reg_number
 * @property string $notes
 * @property integer $inactivated_by_user_id
 * @property string $inactivated_on
 * @property integer $contact_details_id
 * @property integer $delivery_contact_details_id
 * @property integer $created_by_user_id
 * @property string $created
 * @property string $modified
 * @property string $fullname
 * @property string $color
 * @property integer $include_in_diary_route_planning
 *
 * @property ContactDetails $deliveryContactDetails
 * @property ContactDetails $contactDetails
 * @property Product[] $products
 */
class Engineer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'engineer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'company', 'vat_reg_number', 'notes', 'fullname', 'color'], 'string'],
            [['active', 'inactivated_by_user_id', 'contact_details_id', 'delivery_contact_details_id', 'created_by_user_id', 'include_in_diary_route_planning'], 'integer'],
            [['inactivated_on', 'created', 'modified'], 'safe'],
            [['delivery_contact_details_id'], 'exist', 'skipOnError' => true, 'targetClass' => ContactDetails::className(), 'targetAttribute' => ['delivery_contact_details_id' => 'id']],
            [['contact_details_id'], 'exist', 'skipOnError' => true, 'targetClass' => ContactDetails::className(), 'targetAttribute' => ['contact_details_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'active' => 'Active',
            'company' => 'Company',
            'vat_reg_number' => 'Vat Reg Number',
            'notes' => 'Notes',
            'inactivated_by_user_id' => 'Inactivated By User ID',
            'inactivated_on' => 'Inactivated On',
            'contact_details_id' => 'Contact Details ID',
            'delivery_contact_details_id' => 'Delivery Contact Details ID',
            'created_by_user_id' => 'Created By User ID',
            'created' => 'Created',
            'modified' => 'Modified',
            'fullname' => 'Fullname',
            'color' => 'Color',
            'include_in_diary_route_planning' => 'Include In Diary Route Planning',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryContactDetails()
    {
        return $this->hasOne(ContactDetails::className(), ['id' => 'delivery_contact_details_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactDetails()
    {
        return $this->hasOne(ContactDetails::className(), ['id' => 'contact_details_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['engineer_id' => 'id']);
    }
}
