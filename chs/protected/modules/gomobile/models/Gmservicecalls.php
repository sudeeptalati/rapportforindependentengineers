<?php

/**
 * This is the model class for table "gm_servicecalls".
 *
 * The followings are the available columns in table 'gm_servicecalls':
 * @property integer $id
 * @property integer $servicecall_id
 * @property integer $service_reference_number
 * @property integer $server_status_id
 * @property integer $created
 * @property integer $modified
 * @property string $comments
 */
class Gmservicecalls extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gm_servicecalls';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('servicecall_id, service_reference_number, server_status_id, created, modified', 'numerical', 'integerOnly'=>true),
			array('comments', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, servicecall_id, service_reference_number, server_status_id, created, modified, comments', 'safe', 'on'=>'search'),
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
		'server_status'=>	array(self::BELONGS_TO, 'Gmserverstatus', 'server_status_id'),
		'servicecall'=> array(self::BELONGS_TO, 'Servicecall', 'servicecall_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'servicecall_id' => 'Servicecall',
			'service_reference_number' => 'Service Reference Number',
			'server_status_id' => 'Server Status',
			'created' => 'Created',
			'modified' => 'Modified',
			'comments' => 'Comments',
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
		$criteria->compare('servicecall_id',$this->servicecall_id);
		$criteria->compare('service_reference_number',$this->service_reference_number);
		$criteria->compare('server_status_id',$this->server_status_id);
		$criteria->compare('created',$this->created);
		$criteria->compare('modified',$this->modified);
		$criteria->compare('comments',$this->comments,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}///end of search
	
	public function getdatabyserverstatusid($server_status_id)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('server_status_id',$server_status_id);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}////end of getdatabyserverstatusid

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GmServicecalls the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	////creating function to load json file
	public function loadsetupjson()
		 {
			$url = 	Yii::getPathOfAlias('application.modules.gomobile.components');	
			//echo $url.'/graph.json';
			$string = file_get_contents($url.'/setup.json');
			//echo $string;
			$json_a=json_decode($string,true);
			//print_r ($json_a);
			return $json_a;
			
		 }///end of loadjson
	
	
	
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
            	if ($this->active==0)
				{
					
					$this->modified=time();
            	}
            	return true;
            }
        }//end of if(parent())
    }//end of beforeSave()
	
	
	public function getserverurl()
	{
		$json_data=$this->loadsetupjson();
		return $json_data['gomobile_server_url'];
	}//END OF public function getserverurl
	
	public function setserverurl($url)
	{
		$json_data=$this->loadsetupjson();
		return $json_data['gomobile_server_url'];
	}//END OF public function getserverurl
	
	
	
	
	
	public function getaccountid()
	{
		$json_data=$this->loadsetupjson();
		return $json_data['gomobile_account_id'];
	}//END OF public function Getaccountid
	
	public function setaccountid($account_id)
	{	
		defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);	
		$url = 	Yii::getPathOfAlias('application.modules.gomobile.components');	
		$file=$url.DS.'setup.json';
		$string=json_decode(file_get_contents($file));
		print_r($string->gomobile_account_id);
		$string->gomobile_account_id=$account_id;
		//echo $data['gomobile_account_id'];
		$data=json_encode($string);
		file_put_contents($file,$data); 

	}//END OF public function Getaccountid
	
	
	
	
}
