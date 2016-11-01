<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contract_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $information
 * @property integer $created_by_user_id
 * @property string $created
 */
class Contracttype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contract_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'information'], 'string'],
            [['created_by_user_id'], 'integer'],
            [['created'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'information' => Yii::t('app', 'Information'),
            'created_by_user_id' => Yii::t('app', 'Created By User ID'),
            'created' => Yii::t('app', 'Created'),
        ];
    }
}
