<?php

namespace common\models;

use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "document_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $info
 * @property string $category
 */
class Documenttype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'info', 'category'], 'string'],
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
            'info' => Yii::t('app', 'Info'),
            'category' => Yii::t('app', 'Category'),

        ];
    }



    public static function getdocumenttypeslist($category=null)
    {
        if ($category)
            $items = Documenttype::find()->where(['category'=>$category])->all();
        else
            $items = Documenttype::find()->all();


        return ArrayHelper::map($items, 'id', 'name') ;
    }//end of public static function getdocumenttype($type=null)


}
