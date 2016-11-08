<?php

/**
 * This is the model class for table "documents_manuals".
 *
 * The followings are the available columns in table 'documents_manuals':
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
 * @property string $active
 */
class Documentsmanuals extends CActiveRecord
{

    public $upload;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'documents_manuals';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

            array('active,  brand_id, product_type_id, name, filename', 'required'),


			array('active, document_type_id, brand_id, product_type_id, created_by_user_id', 'numerical', 'integerOnly'=>true),
            array('name, description, model_nos, created, filename, version', 'safe'),

            array('upload', 'file', 'types'=>'jpg, gif, png, jpeg, pdf', 'allowEmpty' => true, 'safe' => false),

            // The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('active, id, document_type_id, name, description, brand_id, product_type_id, model_nos, created, created_by_user_id, filename, version', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(

            'document_type' => array(self::BELONGS_TO, 'Documenttype', 'document_type_id'),
            'product_type' => array(self::BELONGS_TO, 'ProductType', 'product_type_id'),
            'brand' => array(self::BELONGS_TO, 'Brand', 'brand_id'),
            'created_by_user' => array(self::BELONGS_TO, 'User', 'created_by_user_id'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
            'id' => 'ID',
            'upload' => 'Upload ',
            'document_type_id' => 'Document Type',
			'name' => 'Name',
			'description' => 'Description',
			'brand_id' => 'Brand',
			'product_type_id' => 'Product Type',
			'model_nos' => 'Model Nos. ',
			'created' => 'Created',
			'created_by_user_id' => 'Created By User',
			'filename' => 'Filename',
			'version' => 'Version',
            'active'=>'Enabled',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('document_type_id',$this->document_type_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('brand_id',$this->brand_id);
		$criteria->compare('product_type_id',$this->product_type_id);
		$criteria->compare('model_nos',$this->model_nos,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('created_by_user_id',$this->created_by_user_id);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('version',$this->version,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'created DESC',
            ),

        ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Documentsmanuals the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    protected function beforeSave()
    {
        if(parent::beforeSave())
        {
            if($this->isNewRecord)  // Creating new record
            {
                $this->created_by_user_id=Yii::app()->user->id;
                $this->created=time();

            }
        }//end of if(parent())

        return true;
    }//end of beforeSave().





    public function getAllDocumenttypesforDropdown()
    { 	
    	////we wonn't display signatures and phpto images. therefore id >5 is selectde
        return CHtml::listData(Documenttype::model()->findAll(array("condition"=>"id > '5'",  'order'=>"`category` ASC")), 'id', 'name');

    }//end of getAllBrands().

    public function getAllproducttypesforDropdown()
    {


        return CHtml::listData(ProductType::model()->findAll(array( 'order'=>"`name` ASC")), 'id', 'name');

    }//end of getAllBrands().


    public function searchbyfilenamemodeldesc($keyword)
    {
        $criteria=new CDbCriteria;
        $criteria->compare('model_nos',$keyword,true, 'OR');
        $criteria->compare('name',$keyword,true, 'OR');
        //$criteria->compare('description',$keyword,true, 'OR');
        $criteria->compare('filename',$keyword,true, 'OR');

		///We will only load manuals 
		$criteria->addCondition('document_type_id > "5"');

        return Documentsmanuals::findAll($criteria);


    }///end of public function searchpartnumberoritemname($keyword)


    public function loadalldocumentsbyservicecallid($service_id)
    {

        $criteria=new CDbCriteria;
        $criteria->compare('servicecall_id',$service_id);

        return Servicecallsdocsmanuals::model()->findAll($criteria);

    }///end of public function loadalldocumentsbyservicecallid($service_id)



}
