<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "master_items".
 *
 * @property integer $id
 * @property string $part_number
 * @property string $name
 * @property string $description
 * @property string $barcode
 * @property integer $category_id
 * @property integer $active
 * @property string $image_url
 * @property double $sale_price
 * @property string $created
 * @property string $modified
 */
class Masteritems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_items';
    }


    public static function freesearch($keyword)
    {


        $query = Masteritems::find()->asArray();

        // add conditions that should always apply here

        $query->orFilterWhere(['like', 'part_number', $keyword])
            ->orFilterWhere(['like', 'name', $keyword])
            ->orFilterWhere(['like', 'description', $keyword])
            ->orFilterWhere(['like', 'barcode', $keyword]);


        $provider = new ActiveDataProvider([
            'query' => $query,

        ]);

        // returns an array of Post objects
        return json_encode($provider->getModels());

    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['part_number', 'name', 'description', 'barcode', 'image_url'], 'string'],
            [['category_id', 'active'], 'integer'],
            [['sale_price'], 'number'],
            [['created'], 'required'],
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
            'part_number' => Yii::t('app', 'Part Number'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'barcode' => Yii::t('app', 'Barcode'),
            'category_id' => Yii::t('app', 'Category ID'),
            'active' => Yii::t('app', 'Active'),
            'image_url' => Yii::t('app', 'Image Url'),
            'sale_price' => Yii::t('app', 'Sale Price'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
        ];
    }////end of public static function freesearch($keyword)


}
