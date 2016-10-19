<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "j324xx_findmyengineer_postcodes".
 *
 * @property integer $postcode_id
 * @property string $postcode_s
 * @property integer $p_x
 * @property integer $p_y
 * @property double $old_latitude
 * @property double $old_longitude
 * @property integer $roundrobin
 */
class Postcodes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fme_postcodes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['postcode_id'], 'required'],
            [['postcode_id', 'p_x', 'p_y', 'roundrobin'], 'integer'],
            [['old_latitude', 'old_longitude'], 'number'],
            [['postcode_s'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'postcode_id' => Yii::t('app', 'Postcode ID'),
            'postcode_s' => Yii::t('app', 'Postcode S'),
            'p_x' => Yii::t('app', 'P X'),
            'p_y' => Yii::t('app', 'P Y'),
            'old_latitude' => Yii::t('app', 'Old Latitude'),
            'old_longitude' => Yii::t('app', 'Old Longitude'),
            'roundrobin' => Yii::t('app', 'Roundrobin'),
        ];
    }

    /**
     * @inheritdoc
     * @return PostcodesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostcodesQuery(get_called_class());
    }
}
