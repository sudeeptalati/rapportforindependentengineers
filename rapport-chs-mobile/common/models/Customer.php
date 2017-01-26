<?php

namespace common\models;


use Yii;

use common\models\Handyfunctions;
/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $title
 * @property string $first_name
 * @property string $last_name
 * @property string $fullname
 * @property string $address_line_1
 * @property string $address_line_2
 * @property string $address_line_3
 * @property string $town
 * @property string $postcode_s
 * @property string $postcode_e
 * @property string $postcode
 * @property string $county
 * @property string $state
 * @property string $country
 * @property string $latitudes
 * @property string $longitudes
 * @property string $telephone
 * @property string $mobile
 * @property string $fax
 * @property string $email
 * @property string $notes
 * @property integer $created_by_user_id
 * @property string $created
 * @property string $modified
 * @property integer $lockcode
 *
 * @property Product[] $products
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'last_name', 'address_line_1', 'town', 'postcode'], 'required'],
            [['product_id', 'created_by_user_id', 'lockcode'], 'integer'],
            [['email'], 'email'],

            [['title', 'first_name', 'last_name', 'fullname', 'address_line_1', 'address_line_2', 'address_line_3', 'town', 'postcode_s', 'postcode_e', 'postcode', 'county', 'state', 'country', 'latitudes', 'longitudes', 'telephone', 'mobile', 'fax', 'email', 'notes'], 'string'],
            [['created', 'modified'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'title' => Yii::t('app', 'Title'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'fullname' => Yii::t('app', 'Fullname'),
            'address_line_1' => Yii::t('app', 'Address Line 1'),
            'address_line_2' => Yii::t('app', 'Address Line 2'),
            'address_line_3' => Yii::t('app', 'Address Line 3'),
            'town' => Yii::t('app', 'Town'),
            'postcode_s' => Yii::t('app', 'Postcode S'),
            'postcode_e' => Yii::t('app', 'Postcode E'),
            'postcode' => Yii::t('app', 'Postcode'),
            'county' => Yii::t('app', 'County'),
            'state' => Yii::t('app', 'State'),
            'country' => Yii::t('app', 'Country'),
            'latitudes' => Yii::t('app', 'Latitudes'),
            'longitudes' => Yii::t('app', 'Longitudes'),
            'telephone' => Yii::t('app', 'Telephone'),
            'mobile' => Yii::t('app', 'Mobile'),
            'fax' => Yii::t('app', 'Parking Restrictions'),
            'email' => Yii::t('app', 'Email'),
            'notes' => Yii::t('app', 'Notes'),
            'created_by_user_id' => Yii::t('app', 'Created By User ID'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
            'lockcode' => Yii::t('app', 'Lockcode'),
        ];
    }

    public function beforeSave($insert)
    {
        $this->fullname=$this->title.' '.$this->first_name.' '.$this->last_name;
        $this->telephone=Handyfunctions::formatphonenoforuk($this->telephone);
        $this->mobile=Handyfunctions::formatphonenoforuk($this->mobile);

        if (parent::beforeSave($insert)) {
            // Place your custom code here

            return true;
        } else {

            return false;
        }
    }//end of before save



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicecalls()
    {
        return $this->hasMany(Servicecall::className(), ['customer_id' => 'id']);
    }




}
