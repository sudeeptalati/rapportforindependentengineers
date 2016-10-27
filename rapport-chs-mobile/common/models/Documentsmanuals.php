<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "documents_manuals".
 *
 * @property integer $id
 * @property integer $document_type_id
 * @property string $name
 * @property string $description
 * @property integer $brand_id
 * @property integer $product_type_id
 * @property string $model_nos
 * @property string $created
 * @property integer $created_by_user_id
 * @property string $filename
 * @property string $version
 * @property integer $active
 */
class Documentsmanuals extends \yii\db\ActiveRecord
{

    public $uploadfile;

    public $base64string;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'documents_manuals';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'name', 'document_type_id', 'filename','brand_id','product_type_id', 'active' ], 'required'],


            ['filename', 'unique', 'targetAttribute' => ['filename'], 'message' => 'This filename is already in use. Please use some other file name.'],


            [['uploadfile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif'],


            [['document_type_id', 'brand_id', 'product_type_id', 'created_by_user_id', 'active'], 'integer'],
            [['name', 'description', 'model_nos', 'filename', 'version'], 'string'],
            [['base64string' , 'created'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'document_type_id' => Yii::t('app', 'Document Type'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'brand_id' => Yii::t('app', 'Brand ID'),
            'product_type_id' => Yii::t('app', 'Product Type ID'),
            'model_nos' => Yii::t('app', 'Model Nos'),
            'created' => Yii::t('app', 'Created'),
            'created_by_user_id' => Yii::t('app', 'Created By User ID'),
            'filename' => Yii::t('app', 'Filename'),
            'version' => Yii::t('app', 'Version'),
            'active' => Yii::t('app', 'Active'),
            'uploadfile' => Yii::t('app', 'Take Photo'),

        ];
    }

    public function upload()
    {

        if ($this->validate()) {
            $this->uploadfile->saveAs( Yii::$app->params['documents_upload_location_absolute_path']. $this->filename);
            return true;
        } else {

            var_dump($this->errors);
            return false;
        }
    }


    public function getDoctype()
    {
        return $this->hasOne(Documenttype::className(), ['id' => 'document_type_id']);
    }


    public static function loadalldocumentsbyservicecallid($service_id)
    {
        $alldocs=Servicecallsdocsmanuals::findAll(['servicecall_id'=>$service_id]);

        $docs_only=array();
        foreach ($alldocs as $alldoc) {

            if ($alldoc->document->doctype->category!="SIGNATURE")
                array_push($docs_only,$alldoc);

        }

        return $docs_only;




    }///end of public function loadalldocumentsbyservicecallid($service_id)


    public static function loadallallsignaturesforservicecallid($service_id)
    {
        $alldocs=Servicecallsdocsmanuals::findAll(['servicecall_id'=>$service_id]);

        $signatures=array();
        foreach ($alldocs as $alldoc) {

            if ($alldoc->document->doctype->category=="SIGNATURE")
                array_push($signatures,$alldoc);

        }

        return $signatures;


    }///end of public function loadalldocumentsbyservicecallid($service_id)






    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Place your custom code here
            $this->created=time();
            $this->created_by_user_id='1';///we will put by default as system admin


            return true;
        } else {

            return false;
        }
    }//end of before save







}
