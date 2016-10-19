<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company_type".
 *
 * @property integer $id
 * @property string $company_type
 */
class Companytype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fme_company_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_type'], 'required'],
            [['company_type'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_type' => 'Company Type',
        ];
    }
}
