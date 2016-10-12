<?php

/**
 * This is the model class for table "servicecalls_docs_manuals".
 *
 * The followings are the available columns in table 'servicecalls_docs_manuals':
 * @property integer $servicecall_id
 * @property integer $document_id
 */
class Servicecallsdocsmanuals extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'servicecalls_docs_manuals';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('servicecall_id, document_id', 'required'),
			array('servicecall_id, document_id', 'numerical', 'integerOnly'=>true),

            array('document_id', 'UniqueAttributesValidator', 'with'=>'servicecall_id', 'message'=>'This document has been already linked'),


			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('servicecall_id, document_id', 'safe', 'on'=>'search'),
		);
	}

    public function primaryKey(){

        return array('servicecall_id', 'document_id');
    }



	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(

            'servicecall' => array(self::BELONGS_TO, 'Servicecall', 'servicecall_id'),
            'documentmanual' => array(self::BELONGS_TO, 'Documentsmanuals', 'document_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'servicecall_id' => 'Servicecall',
			'document_id' => 'Document',
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

		$criteria->compare('servicecall_id',$this->servicecall_id);
		$criteria->compare('document_id',$this->document_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Servicecallsdocsmanuals the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
