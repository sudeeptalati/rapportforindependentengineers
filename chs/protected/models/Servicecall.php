<?php

/**
 * This is the model class for table "servicecall".
 *
 * The followings are the available columns in table 'servicecall':
 * @property integer $id
 * @property integer $service_reference_number
 * @property integer $customer_id
 * @property integer $product_id
 * @property integer $contract_id
 * @property integer $engineer_id
 * @property string $insurer_reference_number
 * @property integer $job_status_id
 * @property string $fault_date
 * @property string $fault_code
 * @property string $fault_description
 * @property string $engg_diary_id
 * @property string $work_carried_out
 * @property integer $spares_used_status_id
 * @property double $total_cost
 * @property double $vat_on_total
 * @property double $net_cost
 * @property string $job_payment_date
 * @property string $job_finished_date
 * @property string $notes
 * @property integer $created_by_user_id
 * @property string $created
 * @property string $modified
 * @property string $cancelled
 * @property string $closed
 * @property integer $recalled_job
 * @property string $activity_log
 * @property string $comments
 * @property string $work_summary
 * @property integer $admintime
 * @property integer $received_remote_data_status
 * @property string $test_results


 * The followings are the available model relations:
 * @property SparesUsedStatus $sparesUsedStatus
 * @property JobStatus $jobStatus
 * @property Engineer $engineer
 * @property Contract $contract
 * @property Product $product
 * @property Customer $customer
 * @property User $createdByUser
 *
 */
class Servicecall extends CActiveRecord
{
    public $user_name;
    public $customer_name;
    public $customer_town;
    public $customer_postcode;
    public $product_name;
    public $model_number;
    public $serial_number;
    public $engineer_name;
    public $contract_name;
    public $job_status;
    public $product_serial_number;
    public $notify_flag = 0;
    public $pervious_job_status;
    public $successfulredirectto;

    ////This will capture only seconds in the instance and will be added to actual column of admintime
    public $time_spent_on_call_now;



    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'servicecall';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('fault_date, fault_description, recalled_job,engineer_id', 'required'),
            array('received_remote_data_status, admintime, created_by_user_id,	service_reference_number, customer_id, product_id, contract_id, engineer_id, job_status_id, spares_used_status_id', 'numerical', 'integerOnly' => true),
            array('total_cost, vat_on_total, net_cost', 'numerical'),
            array('remote_data_sent, communications, remote_data_recieved, remote_ref_no, time_spent_on_call_now, engineer_name, product_serial_number,number_of_visits, customer_town,customer_postcode , recalled_job, activity_log , insurer_reference_number, fault_date, fault_code, engg_diary_id, work_carried_out, job_payment_date, job_finished_date, notes, modified, cancelled, closed, comments, model_number, serial_number, notify_flag, pervious_job_status, work_summary, test_results', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('contract_name, engineer_name,engineer_id, product_serial_number,created_by_user_id, id, customer_town , customer_postcode, customer_name, customer_id, job_status, engineer_name, product_name, service_reference_number, insurer_reference_number, job_status_id, fault_date, fault_code, fault_description, engg_visit_date, work_carried_out, spares_used_status_id, total_cost, vat_on_total, net_cost, job_payment_date, job_finished_date, notes,  created, modified, cancelled, closed, model_number, serial_number', 'safe', 'on' => 'search'),

        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        //Yii::import('application.modules.user.models.*');
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'sparesUsedStatus' => array(self::BELONGS_TO, 'SparesUsedStatus', 'spares_used_status_id'),
            'jobStatus' => array(self::BELONGS_TO, 'JobStatus', 'job_status_id'),
            'engineer' => array(self::BELONGS_TO, 'Engineer', 'engineer_id'),
            'contract' => array(self::BELONGS_TO, 'Contract', 'contract_id'),
            'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
            'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
            'createdByUser' => array(self::BELONGS_TO, 'User', 'created_by_user_id'),
            'enggdiary' => array(self::BELONGS_TO, 'Enggdiary', 'engg_diary_id'),
            'invoice' => array(self::BELONGS_TO, 'Invoice', 'invoice_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'service_reference_number' => 'Job Ref. No#',
            'customer_id' => 'Customer',
            'product_id' => 'Product',
            'contract_id' => 'Job Type',
            'engineer_id' => 'Servicecall Engineer',
            'insurer_reference_number' => ' Reference No# (Eg: DG 1111, SAM 11112, etc)',
            'job_status_id' => 'Job Status',
            'fault_date' => 'Reported Date',
            'fault_code' => 'Agreement No./ Plan No. ',
            'fault_description' => 'Issue Reported',
            'engg_diary_id' => 'Engineer Diary',
            'work_carried_out' => 'Work Carried Out',
            'spares_used_status_id' => 'Spares Used ',
            'total_cost' => 'Total Cost',
            'vat_on_total' => 'Vat On Total',
            'net_cost' => 'Net Cost',
            'job_payment_date' => 'Job Payment Date',
            'job_finished_date' => 'Job Finished Date',
            'notes' => 'BER Authority No. / Booking Time , etc',
            'created_by_user_id' => 'Created By User',
            'created' => 'Created',
            'modified' => 'Modified',
            'cancelled' => 'Cancelled',
            'closed' => 'Closed',
            'customer_town' => 'Town',
            'customer_postcode' => 'Postcode',
            'comments' => 'Comments ',
            'work_summary' => 'Work Summary',
            'admintime'=>'Amount of Administration time for managing service call',
            'received_remote_data_status'=>'Status of Remotely Recieved Data',
            'test_results'=>'Ω Test Results',

        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        //$criteria->order = 'service_reference_number DESC';

        $criteria->with = array('engineer', 'jobStatus', 'customer', 'product', 'contract');
        //$criteria->together= true;

        $criteria->compare('customer.fullname', $this->customer_name, true);
        $criteria->compare('customer.town', $this->customer_town, true);
        $criteria->compare('customer.postcode', $this->customer_postcode, true);


        $criteria->compare('contract.name', $this->contract_name, true);

        $criteria->compare('jobStatus.name', $this->job_status, true);
        $criteria->compare('engineer.company', $this->engineer_name, true);

        $criteria->compare('product.model_number', $this->model_number, true);
        $criteria->compare('product.serial_number', $this->serial_number, true);

        $criteria->compare('id', $this->id);
        $criteria->compare('service_reference_number', $this->service_reference_number);

        $criteria->compare('product_id', $this->product_id);
        $criteria->compare('contract_id', $this->contract_id);
        $criteria->compare('engineer.id', $this->engineer_id);
        $criteria->compare('insurer_reference_number', $this->insurer_reference_number, true);
        $criteria->compare('job_status_id', $this->job_status_id);
        $criteria->compare('fault_date', $this->fault_date, true);
        $criteria->compare('fault_code', $this->fault_code, true);
        $criteria->compare('fault_description', $this->fault_description, true);
        $criteria->compare('engg_diary_id', $this->engg_diary_id, true);
        $criteria->compare('work_carried_out', $this->work_carried_out, true);
        $criteria->compare('spares_used_status_id', $this->spares_used_status_id);
        $criteria->compare('total_cost', $this->total_cost);
        $criteria->compare('vat_on_total', $this->vat_on_total);
        $criteria->compare('net_cost', $this->net_cost);
        $criteria->compare('job_payment_date', $this->job_payment_date, true);
        $criteria->compare('job_finished_date', $this->job_finished_date, true);
        $criteria->compare('notes', $this->notes, true);
        $criteria->compare('created_by_user_id', $this->created_by_user_id);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('cancelled', $this->cancelled, true);
        $criteria->compare('closed', $this->closed, true);
        $criteria->compare('recalled_job', $this->recalled_job, true);
        $criteria->compare('activity_log', $this->activity_log, true);
        //$criteria->compare('work_summary',$this->work_summary, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            //'pagination'=>false,
            'sort' => array(
                'defaultOrder' => 'service_reference_number DESC',
            ),
        ));


    }

    public function getAllContract()
    {
        return CHtml::listData(Contract::model()->findAll(), 'id', 'name', 'contractType.name');
    }//end of search().

    public function getAllEngineers()
    {
        return CHtml::listData(Engineer::model()->findAll(), 'id', 'fullname');
    }//end of beforeSave().

    public function getJobStatus($status_code)
    {
        switch ($status_code) {
            case 1:
                $str = "Draft";
                break;
            case 2:
                $str = "Send";
                break;
            case 3:
                $str = "Rejected";
                break;
            case 4:
                $str = "Partially received";
                break;
            case 5:
                $str = "Received";
                break;
            case 6:
                $str = "Pick Up";
                break;
            case 11:
                $str = "Cancelled";
                break;
            case 12:
                $str = "Deleted";
            //default: break;
        }

        return $str;
    }//END OF afterSave().

    public function freeSearch($keyword)
    {

        /*Creating a new criteria for search*/
        $criteria = new CDbCriteria;

        //$criteria->with = array('customer');
        $criteria->with = array('customer', 'product');


        $criteria->compare('insurer_reference_number', $keyword, true);
        $criteria->compare('service_reference_number', $keyword, true, 'OR');


        $criteria->compare('customer.fullname', $keyword, true, 'OR');
        $criteria->compare('customer.postcode', $keyword, true, 'OR');
        $criteria->compare('customer.mobile', $keyword, true, 'OR');
        $criteria->compare('customer.mobile', $keyword, true, 'OR');

        //$criteria->with = array('product');
        $criteria->compare('product.serial_number', $keyword, true, 'OR');

//        $criteria->with=array('customer');
//        $criteria->compare('customer.fullname', $keyword, true, 'OR');

        /*result limit*/
        //$criteria->limit = 100;
        /*When we want to return model*/
        //return  Servicecall::model()->findAll($criteria);

        /*To return active dataprovider uncomment the following code*/
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => false,
        ));


    }//end of getAllContract().

    public function getStatus()
    {
        return CHtml::listData(JobStatus::model()->findAll(), 'id', 'name');
    }//end of getAllEngineers().

    public function updateStatus()
    {
//    	$result = JobStatus::model()->findAllByAttributes(array(),
//    														'id>:t1 AND published=:t2',
//    														array(':t1'=>2,':t2'=>1),
//    														array('order'=>'view_order')
//    													);

        $result = JobStatus::model()->findAll(
            array(
                'condition' => 'published=1',
                'order' => 'view_order ASC',
            )
        );
        return $result;
    }//end of getJobStatus.

    public function previousCall($customer_id)
    {
        $result = Servicecall::model()->findAllByAttributes(array('customer_id' => $customer_id));
        return $result;

    }//end of free search.

    /**
     * Returns the static model of the specified AR class.
     * @return Servicecall the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }//end of getStatus().

    public function curl_file_get_contents($request)
    {
        $curl_req = curl_init($request);

        curl_setopt($curl_req, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl_req, CURLOPT_HEADER, FALSE);

        $contents = curl_exec($curl_req);

        curl_close($curl_req);

        return $contents;
    }//end of updateStatus().

    public function latestTenResults()
    {
        $criteria = array(
            'order' => 'service_reference_number desc',
            'offset' => 0,
            'limit' => 20
        );
        $list = Servicecall::model()->findAll($criteria);

        $latestResults = new CArrayDataProvider($list, array(
            'id' => 'listid',
            'keyField' => 'id', /*table primary field name*/
            'pagination' => array(
                'pageSize' => 10
            ),
        ));

        return $latestResults;

    }//end of previousCall().

    public function enggJobReport($engg_id, $status_id, $startDate, $endDate)
    {
        //echo "<br> In enggJobReport func ";

        //$engg_id = '90000001';
        //$status_id = '1';
        $from_date = strtotime($startDate);
        $to_date = strtotime($endDate);
//		echo "<br>strtotime of aug = ".strtotime('1-8-12');
//		echo "<br>strtotime of aug = ".strtotime('1-aug-12');

        $exportData = new CDbCriteria();


        if ($engg_id == 0 && $status_id != 0 && $from_date != '' && $endDate != '') {
            //echo "<br> You hv not entered engg id";
            $criteria = new CDbCriteria();
            //$criteria->condition = 'engineer_id='.$engg_id;
            $criteria->condition = 'job_status_id=' . $status_id;
            $criteria->addCondition('job_payment_date BETWEEN :from_date AND :to_date');
            $criteria->params = array(
                ':from_date' => $from_date,
                ':to_date' => $to_date,
            );
            $exportData = new CActiveDataProvider(Servicecall::model(),
                array(
                    'criteria' => $criteria
                ));

        }//Seraches with status_id and dates.

        elseif ($status_id == 0 && $engg_id != 0 && $from_date != '' && $endDate != '') {
            //echo "You have not entered status";
            $criteria = new CDbCriteria();
            $criteria->condition = 'engineer_id=' . $engg_id;
            //$criteria->addCondition('job_status_id='.$status_id);
            $criteria->addCondition('job_payment_date BETWEEN :from_date AND :to_date');
            $criteria->params = array(
                ':from_date' => $from_date,
                ':to_date' => $to_date,
            );
            $exportData = new CActiveDataProvider(Servicecall::model(),
                array(
                    'criteria' => $criteria
                ));
        }//Seraches with engg_id and dates.

        elseif ($from_date == '' && $to_date == '' && $engg_id != 0 && $status_id != 0) {
            //echo "You have not entered any dates";
            $criteria = new CDbCriteria();
            $criteria->condition = 'engineer_id=' . $engg_id;
            $criteria->addCondition('job_status_id=' . $status_id);
//			$criteria->addCondition('fault_date BETWEEN :from_date AND :to_date');
//			$criteria->params = array(
//			  ':from_date' => $from_date,
//			  ':to_date' => $to_date,
//			);
            $exportData = new CActiveDataProvider(Servicecall::model(),
                array(
                    'criteria' => $criteria
                ));
        }//searches with engg_id and status_id.


        elseif ($engg_id == 0 && $status_id == 0) {
            //echo "<br>You have entered only dates";

            $criteria = new CDbCriteria();
            //$criteria->condition = 'engineer_id='.$engg_id;
            //$criteria->condition = 'engineer_id=0';
            //$criteria->addCondition('job_status_id='.$status_id);
            //$criteria->addCondition('job_status_id=0');
            //$criteria->addBetweenCondition('fault_date', $from_date, $to_date, 'AND');
            //$criteria->addBetweenCondition('fault_date', $from_date, $to_date, 'AND');
            $criteria->condition = "fault_date BETWEEN '$from_date' AND '$to_date'";


            $exportData = new CActiveDataProvider(Servicecall::model(),
                array(
                    'criteria' => $criteria
                ));

        }//end of else(), gives all calls within specified dates.

        elseif ($engg_id == 0 && $from_date == '' && $endDate == '') {
            //echo "<br>You have entered only job status";

            $criteria = new CDbCriteria();
            $criteria->condition = 'job_status_id=' . $status_id;
            //$criteria->condition = 'engineer_id=0';
            //$criteria->addCondition('job_status_id='.$status_id);
            //$criteria->addCondition('job_status_id=0');
            //$criteria->addBetweenCondition('fault_date', $from_date, $to_date, 'AND');
            //$criteria->addBetweenCondition('fault_date', $from_date, $to_date, 'AND');
            //$criteria->condition = "fault_date BETWEEN '$from_date' AND '$to_date'";

            $exportData = new CActiveDataProvider(Servicecall::model(), array('criteria' => $criteria));

        }//end of else(), Gives all calls with specific status.

        else {
            //echo "<br>All fields are entered";
            $criteria = new CDbCriteria();
            $criteria->condition = 'engineer_id=' . $engg_id;
            //$criteria->condition = 'engineer_id=0';
            $criteria->addCondition('job_status_id=' . $status_id);
            //$criteria->addCondition('job_status_id=0');
            $criteria->addBetweenCondition('fault_date', $from_date, $to_date, 'AND');
            //$criteria->addBetweenCondition('fault_date', $from_date, $to_date, 'AND');
            //$criteria->condition = "fault_date BETWEEN '$from_date' AND '$to_date'";


            $exportData = new CActiveDataProvider(Servicecall::model(),
                array(
                    'criteria' => $criteria
                ));

        }//end of else, searches with engg_id, status_id and dates.

        return $exportData;

    }///end of functn curl File get contents.

    public function updateengineerbyservicecallid($id, $engineer_id)
    {
        $model = $this->loadmodel($id);
        $servicecall_update = Servicecall::model()->updateByPk($id,
            array(
                'engineer_id' => $engineer_id
            ));

        $product_update = Product::model()->updateByPk($model->product_id,
            array(
                'engineer_id' => $engineer_id
            ));


        return $servicecall_update + $product_update;

    }//end of latestTenResults().

    public function loadmodel($id)
    {
        $model = Servicecall::model()->findByPk($id);
        return $model;
    }//end of enggJobReport().



    public function update_engg_diary_id_by_servicecall_id($id, $engg_diary_id)
    {
        return Servicecall::model()->updateByPk($id,
            array(
                'engg_diary_id' => $engg_diary_id
            ));
    }///end of     public function update_engg_diary_id_by_servicecall_id()




    public function changeengineerbyservicecallid($id, $engineer_id)
    {
        $servicecall_update = Servicecall::model()->updateByPk($id,
            array(
                'engineer_id' => $engineer_id,

            ));

        $this->updateactivitylog($id);

        return $servicecall_update;

    }////end of public function updateengineer($id, $engineer_id)



    public function getserviceidbyservicerefrencenumber($service_reference_number)
    {

        $sc_model=Servicecall::model()->findByAttributes(array('service_reference_number'=>$service_reference_number));
        if ($sc_model)
            return $sc_model->id;
        else
            return null;

    }//end of getserviceidbyservicerefrencenumber


    public function getallsparesbyserviceid($id)
    {
         return SparesUsed::model()->findAllByAttributes(array('servicecall_id' => $id));

    }////end of     public function getallsparesbyserviceid($id)





    public function updatejobstatusbyservicecallid($id, $job_status_id)
    {


        $model = $this->loadmodel($id);

        if ($job_status_id=="102")///which means if job is cancelled.
        {
            ///Cancel all the associated appointments as well
            $criteria=new CDbCriteria;

            $criteria->compare('servicecall_id',$id );


            $all_appointments=Enggdiary::model()->findAll($criteria);

            foreach ($all_appointments as $app)
            {
                if ($app->status!="102")
                {
                    $diary_model=Enggdiary::model()->findByPk($app->id);
                    Enggdiary::model()->cancelappointment($diary_model);
                }
            }
        }


        $servicecall_update = Servicecall::model()->updateByPk($id,
            array(
                'job_status_id' => $job_status_id
            ));


        $this->updateactivitylog($id);

        $this->tellcontractorbyapi($id);

        return $servicecall_update;

    }////end of updatejobstatusbyservicecallid($id, $job_status_id)




    public function tellcontractorbyapi($id)
    {
        $model = $this->loadmodel($id);
        $status_log=strip_tags($model->activity_log);

        /////   Find contract
        if (!empty($model->contract->api_key))
        {

            $portal_url = $model->contract->portal_url;
            $e = $model->contract->portal_login_email;
            $p = $model->contract->portal_encrypt_pass;

            $method = "POST";

            $url = $portal_url . "?r=servicecalls/sendstatusupdatetoamica";

            $data = "email=" . $e . "&pwd=" . $p . "&remote_ref_no=" . $model->remote_ref_no. "&api_key=" . $model->contract->api_key. "&status_log=" . $status_log;

            //echo $url;

            $result = Setup::model()->callportal($url, $data, $method);

            echo $result;

        }



    }/////end of public function notifycontractor()


    public function sendclaimviaapi($id)
    {
        $model=Servicecall::model()->findByPk($id);

        $portal_url = $model->contract->portal_url;
        $e = $model->contract->portal_login_email;
        $p = $model->contract->portal_encrypt_pass;

        $method = "post";

        $url = $portal_url . "?r=servicecalls/postdatatorazzserverviaportal";

        $data = "email=" . $e . "&pwd=" . $p . "&remote_ref_no=" . $model->remote_ref_no. "&api_key=" . $model->contract->api_key. "&json_post_data=" . $model->remote_data_sent;

        //echo $url;

        $result = Setup::model()->callportal($url, $data, $method);

        return $result;



    }///end of public function sendclaimtoviaapi($data)









    public function updateadmintimebyservicecallid($id, $admintimeinseconds)
    {
        $model = $this->loadmodel($id);

        $total_admin_time=$model->admintime+$admintimeinseconds;


        $servicecall_update = Servicecall::model()->updateByPk($id,
            array(
                'admintime' => $total_admin_time
            ));

        return $total_admin_time;

    }////end of public function updateengineer($id, $engineer_id)






    public function updateactivitylog($id)
    {
        ////Make sure Activity log is set to 0 before using this
        ////UPDATE 'servicecall' SET "activity_log"='' WHERE 1

        $model = $this->loadmodel($id);

        $activity_log = trim($model->activity_log);

        if ($activity_log == '') {
            $activity_log_array = array();
        }///end of if ($activity_log=='')
        else {
            $activity_log_array = json_decode($activity_log, true);
        }/////end of else ($activity_log=='')

        $log = array();
        $log['time'] = Setup::model()->getdatetime();
        $log['jobstatus'] = $model->jobStatus->name;
        $log['engineer'] = $model->engineer->company . ', ' . $model->engineer->fullname;
        $log['user'] = Yii::app()->user->name;
        $log['comments']="";

        if ($model->engg_diary_id && $model->job_status_id==3)
        {
            $visit_date=Setup::model()->formatdate($model->enggdiary->visit_start_date);
            $log['comments']= "Engineer Visit Date: ".$visit_date;

        }





        array_push($activity_log_array, $log);


        Servicecall::model()->updateByPk($id,
            array(
                'activity_log' => json_encode($activity_log_array),

            ));

        //return "hello ";


    }//end of public function writeactivitylog($this->activity_log);

    protected function beforeSave()
    {


        $this->admintime=$this->time_spent_on_call_now+$this->admintime;

        $setupModel = Setup::model()->findByPk(1);
        $vatPercentage = $setupModel->alternate;

        $this->vat_on_total = ($this->total_cost * $vatPercentage) / 100;
        $this->net_cost = $this->total_cost + $this->vat_on_total;

        $this->vat_on_total = number_format($this->vat_on_total, 2, '.', '');
        $this->net_cost = number_format($this->net_cost, 2, '.', '');


        if (parent::beforeSave()) {

            /*
            $this->job_payment_date = strtotime($this->job_payment_date);
            $this->job_finished_date = strtotime($this->job_finished_date);
            $this->fault_date = strtotime($this->fault_date);
            */

            if ($this->isNewRecord)  // Creating new record
            {
                $this->created_by_user_id = Yii::app()->user->id;
                $this->created = time();

                //SETTING SERVICE REFERENCE NUMBER.
                $count_sql = "SELECT COUNT(*) FROM servicecall";
                $total_records = Yii::app()->db->createCommand($count_sql)->queryScalar();
                if ($total_records == 0) {
                    $this->service_reference_number = 200001;
                }//end of if
                else {
                    $last_po_number = Yii::app()->db->createCommand()
                        ->select('id , service_reference_number')
                        ->from('servicecall')
                        ->order('id DESC')
                        ->limit(1, 0);
                    $data = $last_po_number->query();
                    foreach ($data as $out) {
                        $serviceRefNo = $out['service_reference_number'];
                        $this->service_reference_number = $serviceRefNo + 1;
                    }///end of foreach
                }//end of else.
                /******* END OF SETTING service_reference_number ********/

                return true;

            }//end of if(newrecord).
            /****** END OF IF OF NEW RECORD ************/

            /********* THIS BIT IS CALLED DURING UPDATE *********/
            else {
                $current_user = Yii::app()->user->name;
                $this->modified = time();
                $this->comments = Setup::model()->updatenotesorcomments($this->comments, $this, 'comments');

                return true;
            }

        }//end of if(parent())

    }////end of public function updateengineer($id, $engineer_id)

    protected function afterSave()
    {
        //echo "<br>AFTER SAVE OF SERVICECALL CALLED";
        $productUpdateModel = Customer::model()->updateByPk($this->product_id,
            array('lockcode' => 0)
        );

        $customerUpdateModel = Customer::model()->updateByPk($this->customer_id,
            array('lockcode' => 0)
        );
    }





}//end of class.