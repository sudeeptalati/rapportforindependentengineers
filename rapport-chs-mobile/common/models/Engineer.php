<?php

namespace common\models;

use Yii;

use yii\behaviors\TimestampBehavior;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "j324xx_findmyengineer_technician".
 *
 * @property integer $id
 * @property string $name
 * @property integer $user_id
 * @property integer company_type_id
 * @property integer $wta_member
 * @property integer $wta_associate_member
 * @property string $wta_membership_number
 * @property string $wta_membership_expiry_date
 * @property string $line_1
 * @property string $line_2
 * @property string $line_3
 * @property string $town
 * @property string $county
 * @property string $postcode_s
 * @property string $postcode_e
 * @property double $latitude
 * @property double $longitude
 * @property integer $weight
 * @property string $email
 * @property string $phone
 * @property string $cell
 * @property string $fax
 * @property integer $on_holiday
 * @property string $blurb
 * @property integer $published
 * @property integer $ordering
 * @property string $web_site
 * @property string $unverified_email
 * @property string $comments
 * @property string $business_principle
 * @property integer $staffted_office
 * @property string $total_employees
 * @property string $total_engineers
 * @property string $average_response_time
 * @property string $average_turnover
 * @property string $company_reg_number
 * @property string $vat_number
 * @property string $working_premises
 * @property integer $accept_contracts
 * @property integer $accept_spot_contracts
 * @property string $accounts_contact_person
 * @property string $accounts_contact_address
 * @property string $accounts_telephone
 * @property string $accounts_email
 * @property string $created
 * @property string $modified
 * @property integer $phoneclicks
 * @property integer $enquiryclicks
 * @property integer $mapclicks
 * @property integer $impressions
 * @property integer $sms_credits
 * @property string $rapport_chs_url
 * @property string rapport_api_key
 */



class Engineer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fme_technician';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sms_credits', 'user_id', 'phoneclicks', 'enquiryclicks', 'mapclicks', 'impressions',  'company_type_id', 'wta_member', 'wta_associate_member', 'weight', 'on_holiday', 'published', 'ordering', 'staffted_office', 'accept_contracts', 'accept_spot_contracts'], 'integer'],
            [['rapport_api_key', 'rapport_chs_url','wta_membership_number', 'comments', 'business_principle', 'accounts_contact_address'], 'string'],
            [['rapport_api_key','rapport_chs_url', 'wta_membership_expiry_date', 'created', 'modified'], 'safe'],
            [['latitude', 'longitude'], 'number'],
            [['rapport_api_key', 'rapport_chs_url'], 'unique'],

            [['name', 'line_1', 'line_2', 'line_3', 'town', 'county', 'email', 'blurb', 'unverified_email', 'total_employees', 'total_engineers', 'average_turnover', 'company_reg_number', 'vat_number', 'accounts_contact_person', 'accounts_email'], 'string', 'max' => 255],
            [['postcode_s'], 'string', 'max' => 4],
            [['postcode_e'], 'string', 'max' => 3],
            [['phone', 'cell', 'fax'], 'string', 'max' => 20],
            [['web_site'], 'string', 'max' => 128],
            [['average_response_time', 'working_premises', 'accounts_telephone'], 'string', 'max' => 64],
        ];
    }

    /***
     * @return array
     * @behaviours
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'modified',
                ],
                'value' => function() {
                    return date('Y-m-d h:i:s'); // unix timestamp
                },
            ],
        ];
    }//end of behaviors




    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'user_id' => Yii::t('app', 'User ID'),
            'company_type_id' => Yii::t('app', 'Company Type'),
            'wta_member' => Yii::t('app', 'Wta Member'),
            'wta_associate_member' => Yii::t('app', 'Wta Associate Member'),
            'wta_membership_number' => Yii::t('app', 'Wta Membership Number'),
            'wta_membership_expiry_date' => Yii::t('app', 'Wta Membership Expiry Date'),
            'line_1' => Yii::t('app', 'Address Line 1'),
            'line_2' => Yii::t('app', 'Address Line 2'),
            'line_3' => Yii::t('app', 'Address Line 3'),
            'town' => Yii::t('app', 'Town'),
            'county' => Yii::t('app', 'County'),
            'postcode_s' => Yii::t('app', 'Postcode S'),
            'postcode_e' => Yii::t('app', 'Postcode E'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'weight' => Yii::t('app', 'Weight'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'cell' => Yii::t('app', 'Cell'),
            'fax' => Yii::t('app', 'Fax'),
            'on_holiday' => Yii::t('app', 'On Holiday'),
            'blurb' => Yii::t('app', 'Blurb'),
            'published' => Yii::t('app', 'Active'),
            'ordering' => Yii::t('app', 'Ordering'),
            'web_site' => Yii::t('app', 'Web Site'),
            'unverified_email' => Yii::t('app', 'Unverified Email'),
            'comments' => Yii::t('app', 'Comments'),
            'business_principle' => Yii::t('app', 'Business Principle'),
            'staffted_office' => Yii::t('app', 'Staffted Office'),
            'total_employees' => Yii::t('app', 'Total Employees'),
            'total_engineers' => Yii::t('app', 'Total Engineers'),
            'average_response_time' => Yii::t('app', 'Average Response Time'),
            'average_turnover' => Yii::t('app', 'Average Turnover'),
            'company_reg_number' => Yii::t('app', 'Company Reg Number'),
            'vat_number' => Yii::t('app', 'Vat Number'),
            'working_premises' => Yii::t('app', 'Working Premises'),
            'accept_contracts' => Yii::t('app', 'Accept Contracts'),
            'accept_spot_contracts' => Yii::t('app', 'Accept Spot Contracts'),
            'accounts_contact_person' => Yii::t('app', 'Accounts Contact Person'),
            'accounts_contact_address' => Yii::t('app', 'Accounts Contact Address'),
            'accounts_telephone' => Yii::t('app', 'Accounts Telephone'),
            'accounts_email' => Yii::t('app', 'Accounts Email'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
            'phoneclicks' => Yii::t('app', 'Phone Clicks'),
            'enquiryclicks' => Yii::t('app', 'Enquiry Clicks'),
            'mapclicks' => Yii::t('app', 'Map Clicks'),

            'impressions' => Yii::t('app', 'Impressions'),
            'sms_credits' => Yii::t('app', 'SMS Credits'),
            'rapport_chs_url' => Yii::t('app', 'Rapport Call Handling Url'),
            'rapport_api_key' => Yii::t('app', 'Rapport Call Handling API Key'),

        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function findIdentityByUserId($user_id)
    {
        return static::findOne(['user_id' => $user_id]);
    }




    /**
     * @relations return \yii\db\ActiveQuery
     */
    public function getEngineerproducttypes()
    {
        return $this->hasMany(Engineerproducttype::className(), ['technician_id' => 'id']);
        //return 'OK';
    }

    public function getEngineerbrands()
    {
        return $this->hasMany(Engineerbrands::className(), ['technician_id' => 'id']);
        //return 'OK';
    }

    public function getEngineerpostcodes()
    {
        return $this->hasMany(Engineerpostcodes::className(), ['technician_id' => 'id']);
        //return 'OK';
    }


    public function getEngineerauthorisedbrands()
    {
        return $this->hasMany(Engineerauthorisedbrands::className(), ['technician_id' => 'id']);
        //return 'OK';
    }




    public function getCompanytype()
    {
        return $this->hasOne(Companytype::className(), ['id' => 'company_type_id']);
        //return 'OK';
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
        //return 'OK';
    }





}
