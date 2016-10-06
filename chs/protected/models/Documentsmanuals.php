<?php

/**
 * This is the model class for table "documents_manuals".
 *
 * The followings are the available columns in table 'documents_manuals':
 * @property integer $id
 * @property integer $parent_document_id
 * @property string $name
 * @property string $description
 * @property integer $brand_id
 * @property integer $product_type_id
 * @property string $model_nos
 * @property string $created
 * @property integer $created_by_user_id
 */
class Documentsmanuals extends CActiveRecord
{
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
			array('parent_document_id, brand_id, product_type_id, created_by_user_id', 'numerical', 'integerOnly'=>true),
			array('name, description, model_nos, created', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, parent_document_id, name, description, brand_id, product_type_id, model_nos, created, created_by_user_id', 'safe', 'on'=>'search'),
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
            'productType' => array(self::BELONGS_TO, 'ProductType', 'product_type_id'),
            'brand' => array(self::BELONGS_TO, 'Brand', 'brand_id'),
            'createdby' => array(self::BELONGS_TO, 'User', 'created_by_user_id'),
        );
    }



	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_document_id' => 'Parent Document',
			'name' => 'Name',
			'description' => 'Description',
			'brand_id' => 'Brand',
			'product_type_id' => 'Product Type',
			'model_nos' => 'Model Nos',
			'created' => 'Created',
			'created_by_user_id' => 'Created By User',
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
		$criteria->compare('parent_document_id',$this->parent_document_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('brand_id',$this->brand_id);
		$criteria->compare('product_type_id',$this->product_type_id);
		$criteria->compare('model_nos',$this->model_nos,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('created_by_user_id',$this->created_by_user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
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
}
