<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "setup".
 *
 * @property integer $id
 * @property string $company
 * @property string $address
 * @property string $town
 * @property string $postcode_s
 * @property string $postcode_e
 * @property string $county
 * @property integer $country_id
 * @property string $email
 * @property string $telephone
 * @property string $mobile
 * @property string $alternate
 * @property string $fax
 * @property string $postcodeanywhere_account_code
 * @property string $postcodeanywhere_license_key
 * @property string $website
 * @property string $vat_reg_no
 * @property string $company_number
 * @property string $postcode
 * @property string $version_update_url
 * @property integer $live_booking_id
 */
class Setup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company', 'address', 'town', 'postcode_s', 'postcode_e', 'county', 'email', 'telephone', 'mobile', 'alternate', 'fax', 'postcodeanywhere_account_code', 'postcodeanywhere_license_key', 'website', 'vat_reg_no', 'company_number', 'postcode', 'version_update_url'], 'string'],
            [['country_id', 'live_booking_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company' => 'Company',
            'address' => 'Address',
            'town' => 'Town',
            'postcode_s' => 'Postcode S',
            'postcode_e' => 'Postcode E',
            'county' => 'County',
            'country_id' => 'Country ID',
            'email' => 'Email',
            'telephone' => 'Telephone',
            'mobile' => 'Mobile',
            'alternate' => 'Alternate',
            'fax' => 'Fax',
            'postcodeanywhere_account_code' => 'Postcodeanywhere Account Code',
            'postcodeanywhere_license_key' => 'Postcodeanywhere License Key',
            'website' => 'Website',
            'vat_reg_no' => 'Vat Reg No',
            'company_number' => 'Company Number',
            'postcode' => 'Postcode',
            'version_update_url' => 'Version Update Url',
            'live_booking_id' => 'Live Booking ID',
        ];
    }

    public static function loadmycompanydetails()
    {
        return self::findOne('1');
    }


}
