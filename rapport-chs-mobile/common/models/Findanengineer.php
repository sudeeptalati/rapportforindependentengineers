<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\db\Query ;

/**
 * Login form
 */
class Findanengineer extends Model
{
    public $postcode;
    public $latitude;
    public $longitude;
    public $postcode_s;
    public $postcode_e;
    public $town;
    public $brand_id;
    public $product_type_id;

    public $brand_name;
    public $product_type_name;



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['postcode', 'latitude',  'longitude', 'brand_id', 'product_type_id'], 'required'],
            // rememberMe must be a boolean value
             ['town', 'required',  'message' => 'Please enter a valid UK postcode'],
            ['postcode_s', 'required',  'message' => 'Postcode'],
            ['postcode_e', 'required',  'message' => '-Invalid '],


            ['rememberMe', 'boolean'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'postcode_s' => Yii::t('app', 'First Part'),
            'postcode_e' => Yii::t('app', 'Second Part'),
            'postcode' => Yii::t('app', 'Postcode'),
            'town' => Yii::t('app', 'Town'),
            'latitude' => Yii::t('app', 'Latitudes'),
            'longitude' => Yii::t('app', 'Longitudes'),
            'brand_id' => Yii::t('app', 'Brand'),
            'product_type_id' => Yii::t('app', 'Product Type'),
        ];
    }






    public function if_postcode_exists($postcode_s)
    {
        $postcode_s=Postcodes::find()->where(['postcode_s' => $postcode_s])->one();
        if ($postcode_s)
            return true;
        else
            return false;
    }


    public function find_engineer_with($postcode_s, $brand_id, $product_type_id)
    {
        /*
         *
         * 		$query
			->select('*')
			->from($db->quoteName('#__findmyengineer_technician'))
			->join('INNER', $db->quoteName('#__findmyengineer_technician_manufacturer') . ' ON (' . $db->quoteName('#__findmyengineer_technician.id') . ' = ' . $db->quoteName('#__findmyengineer_technician_manufacturer.technician_id') . ')')
			->join('INNER', $db->quoteName('#__findmyengineer_technician_product_type') . ' ON (' . $db->quoteName('#__findmyengineer_technician.id') . ' = ' . $db->quoteName('#__findmyengineer_technician_product_type.technician_id') . ')')
			->join('INNER', $db->quoteName('#__findmyengineer_postcodes_technician') . ' ON (' . $db->quoteName('#__findmyengineer_technician.id') . ' = ' . $db->quoteName('#__findmyengineer_postcodes_technician.technician_id') . ')')
			->join('INNER', $db->quoteName('#__findmyengineer_postcodes') . ' ON (' . $db->quoteName('#__findmyengineer_postcodes.postcode_id') . ' = ' . $db->quoteName('#__findmyengineer_postcodes_technician.postcode_id') . ')')
			->where($db->quoteName('#__findmyengineer_technician_manufacturer.manufacturer_id') .'='.$manufacturer_id . ' AND '.$db->quoteName('#__findmyengineer_technician_product_type.product_id') .'='.$product_id . ' AND ' .$db->quoteName('#__findmyengineer_postcodes.postcode_s') . ' = "'.$postcode_value.'"')
			->order($db->quoteName('#__findmyengineer_technician.wta_member') . ' DESC');


         */
        $query = new Query;
        $query	->select('*')
            ->from('fme_technician')
            ->join('INNER JOIN', 'fme_technician_manufacturer',
                ' fme_technician.id=fme_technician_manufacturer.technician_id')

            ->join('INNER JOIN', 'fme_technician_product_type',
                ' fme_technician.id=fme_technician_product_type.technician_id')

            ->join('INNER JOIN', 'fme_postcodes_technician',
                ' fme_technician.id=fme_postcodes_technician.technician_id')

            ->join('INNER JOIN', 'fme_postcodes',
                ' fme_postcodes.postcode_id=fme_postcodes_technician.postcode_id')

            ->where([
                'fme_technician_manufacturer.manufacturer_id' => $brand_id,
                'fme_technician_product_type.product_id'=>$product_type_id,
                'fme_postcodes.postcode_s'=>$postcode_s
            ])
            ->orderBy('fme_technician.wta_member DESC')
        ;

            $command = $query->createCommand();
            return $command->queryAll();

    }///end of public function findnearestengineer($postcode, $brand_id, $product_type_id)


    public static function check_rapport_url_is_valid($url, $api_key)
    {
        $url=trim($url);
        if (empty($url))
            return 'NO_URL';
        $url=$url.'?r=api/checkservice';

        $result=Handyfunctions::curl_file_get_contents($url);
        $result_json= Handyfunctions::decode_json_string($result);

        if ($result_json)
        {
            if ($result_json->api_key==$api_key)
                 return $result_json->status;
            else
                return 'UNKNOWN_API_KEY';

        }else
        {
            return 'URL_OR_JSON_ERROR';
        }

    }///end of     public static function check_rapport_url_is_valid()


}
