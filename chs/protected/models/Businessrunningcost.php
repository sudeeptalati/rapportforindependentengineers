<?php

/**
 * This is the model class for table "business_running_cost".
 *
 * The followings are the available columns in table 'business_running_cost':
 * @property integer $id
 * @property string $cost_of
 * @property double $weekly_cost
 * @property double $monthly_cost
 * @property double $yearly_cost
 * @property double $daily_cost
 */
class Businessrunningcost extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'business_running_cost';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

            array('cost_of, weekly_cost, monthly_cost, yearly_cost, daily_cost', 'required'),
            array('weekly_cost, monthly_cost, yearly_cost, daily_cost', 'numerical'),
            array('cost_of', 'safe'),
            array('unique', 'safe'),
            // The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cost_of, weekly_cost, monthly_cost, yearly_cost, daily_cost', 'safe', 'on'=>'search'),
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
			'cost_of' => 'Cost of ',
			'weekly_cost' => 'Weekly Cost ( £ ) ',
			'monthly_cost' => 'Monthly Cost ( £ )  ',
			'yearly_cost' => 'Yearly Cost ( £ ) ',
			'daily_cost' => 'Everyday Cost ( £ ) ',
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
		$criteria->compare('cost_of',$this->cost_of,true);
		$criteria->compare('weekly_cost',$this->weekly_cost);
		$criteria->compare('monthly_cost',$this->monthly_cost);
		$criteria->compare('yearly_cost',$this->yearly_cost);
		$criteria->compare('daily_cost',$this->daily_cost);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function loadallcosts()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('cost_of',$this->cost_of,true);
        $criteria->compare('weekly_cost',$this->weekly_cost);
        $criteria->compare('monthly_cost',$this->monthly_cost);
        $criteria->compare('yearly_cost',$this->yearly_cost);
        $criteria->compare('daily_cost',$this->daily_cost);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>false,
        ));

    }


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Businessrunningcost the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function get_total_business_running_cost()
    {
        $total_business_running_cost=array();

        $daily=0;
        $weekly=0;
        $monthly=0;
        $yearly=0;

        $costs=$this->findAll();

        foreach ($costs as $c)
        {
            $daily=$daily+$c->daily_cost;
            $weekly=$weekly+$c->weekly_cost;
            $monthly=$monthly+$c->monthly_cost;
            $yearly=$yearly+$c->yearly_cost;

        }//end of foreach ($costs as $c)


        $total_business_running_cost['daily_cost']=$daily;
        $total_business_running_cost['weekly_cost']=$weekly;
        $total_business_running_cost['monthly_cost']=$monthly;
        $total_business_running_cost['yearly_cost']=$yearly;

        return $total_business_running_cost;

    }///end of get_total_business_running_cost



    public function get_total_no_of_servicecalls_in_last_30days()
    {


        $yesterday=date('d-n-Y',strtotime("-1 days"));
        $last_month_date=date('d-n-Y',strtotime("-31 days"));

        //http://127.0.0.1/rapport/forengineers/rapportforindependentengineers/chs/index.php?r=graph/default/GetCustomDaysData&start_date=14-11-2016&end_date=14-12-2016&weekdays=1234567&job_status_id=0


        $data_url=Yii::app()->createAbsoluteUrl('graph/default/GetCustomDaysData',array(
            'start_date'=>$last_month_date,
            'end_date'=>$yesterday,
            'weekdays'=>'1234567',
            'job_status_id'=>'0',

        ));



        $output=Setup::model()->curl_file_get_contents($data_url);

        $output_json=json_decode($output);

        return $output_json->total_calls;

    }///end of  public function get_total_no_of_servicecalls_in_last_30days()

    public function get_cost_per_call($total_cost, $total_calls)
    {
        $output=$total_cost/$total_calls;

        return $output;
    }



}
