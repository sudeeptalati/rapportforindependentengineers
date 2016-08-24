<?php

/**
 * This is the model class for table "master_items".
 *
 * The followings are the available columns in table 'master_items':
 * @property integer $id
 * @property string $part_number
 * @property string $name
 * @property string $description
 * @property string $barcode
 * @property integer $category_id
 * @property integer $active
 * @property string $image_url
 * @property double $sale_price
 * @property string $created
 * @property string $modified
 */
class MasterItems extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'master_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('category_id, active', 'numerical', 'integerOnly'=>true),
			array('sale_price', 'numerical'),
			array('part_number, description, barcode, image_url, modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, part_number, name, description, barcode, category_id, active, image_url, sale_price, created, modified', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'part_number' => 'Part Number',
			'name' => 'Name',
			'description' => 'Description',
			'barcode' => 'Barcode',
			'category_id' => 'Category',
			'active' => 'Active',
			'image_url' => 'Image Url',
			'sale_price' => 'Sale Price',
			'created' => 'Created',
			'modified' => 'Modified',
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
		$criteria->compare('part_number',$this->part_number,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('barcode',$this->barcode,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('active',$this->active);
		$criteria->compare('image_url',$this->image_url,true);
		$criteria->compare('sale_price',$this->sale_price);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MasterItems the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function searchpartnumberoritemname($keyword)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('part_number',$keyword,true, 'OR');
		$criteria->compare('name',$keyword,true, 'OR');
		$criteria->compare('description',$keyword,true, 'OR');
		$criteria->compare('barcode',$keyword,true, 'OR');

		return MasterItems::findAll($criteria);


	}///end of public function searchpartnumberoritemname($keyword)


	protected function beforeSave()
	{

		if(parent::beforeSave())
		{
			if($this->isNewRecord)  // Creating new record
			{

				$this->created=time();
				return true;
			}
			else
			{
				$this->modified=time();
				return true;
			}
		}
	}//end of beforeSave().


}
