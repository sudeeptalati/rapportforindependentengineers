<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contact_details".
 *
 * @property integer $id
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
 * @property string $mobile
 * @property string $telephone
 * @property string $fax
 * @property string $email
 * @property string $website
 * @property string $created
 * @property integer $lockcode
 *
 * @property Engineer[] $engineers
 * @property Engineer[] $engineers0
 */
class Contactdetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address_line_1', 'address_line_2', 'address_line_3', 'town', 'postcode_s', 'postcode_e', 'postcode', 'county', 'state', 'country', 'latitudes', 'longitudes', 'mobile', 'telephone', 'fax', 'email', 'website'], 'string'],
            [['created'], 'safe'],
            [['lockcode'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address_line_1' => 'Address Line 1',
            'address_line_2' => 'Address Line 2',
            'address_line_3' => 'Address Line 3',
            'town' => 'Town',
            'postcode_s' => 'Postcode S',
            'postcode_e' => 'Postcode E',
            'postcode' => 'Postcode',
            'county' => 'County',
            'state' => 'State',
            'country' => 'Country',
            'latitudes' => 'Latitudes',
            'longitudes' => 'Longitudes',
            'mobile' => 'Mobile',
            'telephone' => 'Telephone',
            'fax' => 'Fax',
            'email' => 'Email',
            'website' => 'Website',
            'created' => 'Created',
            'lockcode' => 'Lockcode',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEngineers()
    {
        return $this->hasMany(Engineer::className(), ['delivery_contact_details_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEngineers0()
    {
        return $this->hasMany(Engineer::className(), ['contact_details_id' => 'id']);
    }
}
