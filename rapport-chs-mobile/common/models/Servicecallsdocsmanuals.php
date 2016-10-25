<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "servicecalls_docs_manuals".
 *
 * @property integer $servicecall_id
 * @property integer $document_id
 */
class Servicecallsdocsmanuals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicecalls_docs_manuals';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['servicecall_id', 'document_id'], 'required'],
            [['servicecall_id', 'document_id'], 'integer'],
            [['document_id', 'servicecall_id'], 'unique', 'targetAttribute' => ['document_id', 'servicecall_id'], 'message' => 'The combination of Servicecall ID and Document ID has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'servicecall_id' => Yii::t('app', 'Servicecall ID'),
            'document_id' => Yii::t('app', 'Document ID'),
        ];
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicecall()
    {
        return $this->hasOne(Servicecall::className(), ['id' => 'servicecall_id']);
    }

    /**
     *
     */
    public function getDocument()
    {
        return $this->hasOne(Documentsmanuals::className(), ['id' => 'document_id']);
    }


}
