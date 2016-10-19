<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property integer $id
 * @property string $name
 * @property string $html_name
 * @property string $created
 * @property string $modified
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['html_name'], 'string'],
            [['created', 'modified'], 'safe'],
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'html_name' => '	',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }
}
