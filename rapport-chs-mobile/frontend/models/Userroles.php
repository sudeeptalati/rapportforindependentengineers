<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "userroles".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $email
 * @property integer $role_type_id
 * @property integer $active
 * @property string $created
 * @property string $modified
 */
class Userroles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userroles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'email', 'role_type_id', 'active'], 'required'],
            [['user_id', 'role_type_id', 'active'], 'integer'],
            [['email'], 'string'],
            [['created', 'modified'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'email' => 'Email',
            'role_type_id' => 'Role Type ID',
            'active' => 'Active',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }
}
