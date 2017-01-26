<?php

namespace common\models;

use Yii;
use common\models\Handyfunctions;

/**
 * This is the model class for table "servicecall".
 *
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
 * @property integer $engg_diary_id
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
 * @property integer $number_of_visits
 * @property string $activity_log
 * @property string $comments
 * @property integer $recalled_job
 * @property string $work_summary
 * @property integer $admintime
 * @property string $remote_ref_no
 * @property string $remote_data_recieved
 * @property string $communications
 * @property string $remote_data_sent
 * @property string $test_results
 * @property integer $received_remote_data_status
 */
class Servicecall extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicecall';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_reference_number', 'customer_id', 'product_id', 'contract_id', 'engineer_id', 'job_status_id', 'engg_diary_id', 'spares_used_status_id', 'created_by_user_id', 'number_of_visits', 'recalled_job'], 'integer'],
            [['test_results', 'insurer_reference_number', 'fault_code', 'fault_description', 'work_carried_out', 'notes', 'activity_log', 'comments', 'work_summary'], 'string'],
            [['fault_date', 'job_payment_date', 'job_finished_date', 'created', 'modified', 'cancelled', 'closed'], 'safe'],
            [['total_cost', 'vat_on_total', 'net_cost'], 'number'],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobstatus()
    {
        return $this->hasOne(Jobstatus::className(), ['id' => 'job_status_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContract()
    {
        return $this->hasOne(Contract::className(), ['id' => 'contract_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEngineer()
    {
        return $this->hasOne(Engineer::className(), ['id' => 'engineer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnggdiary()
    {
        return $this->hasOne(Enggdiary::className(), ['id' => 'engg_diary_id']);
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_reference_number' => 'Job Ref. No# ',
            'customer_id' => 'Customer ',
            'product_id' => 'Product ',
            'contract_id' => 'Contract ',
            'engineer_id' => 'Engineer ',
            'insurer_reference_number' => 'Insurer Reference Number',
            'job_status_id' => 'Job Status ',
            'fault_date' => 'Fault Date',
            'fault_code' => 'Fault Code',
            'fault_description' => 'Fault Description',
            'engg_diary_id' => 'Engg Diary ',
            'work_carried_out' => 'Work Carried Out',
            'spares_used_status_id' => 'Spares Used Status ',
            'total_cost' => 'Total Cost',
            'vat_on_total' => 'Vat On Total',
            'net_cost' => 'Net Cost',
            'job_payment_date' => 'Job Payment Date',
            'job_finished_date' => 'Job Finished Date',
            'notes' => 'Notes',
            'created_by_user_id' => 'Created By User ',
            'created' => 'Created',
            'modified' => 'Modified',
            'cancelled' => 'Cancelled',
            'closed' => 'Closed',
            'number_of_visits' => 'Number Of Visits',
            'activity_log' => 'Activity Log',
            'comments' => 'Comments',
            'recalled_job' => 'Recalled Job',
            'work_summary' => 'Work Summary',
            'admintime' => 'Admintime',
            'remote_ref_no' => 'Remote Ref No',
            'remote_data_recieved' => 'Remote Data Recieved',
            'communications' => 'Communications',
            'remote_data_sent' => 'Remote Data Sent',
            'test_results' => 'Ω  Test Results',
            'received_remote_data_status' => 'Received Remote Data Status',

            ///Custom Labels
            'contract' => 'Contract',
        ];
    }


    /**
     * @param $servicecall_id
     * @return int
     */
    public static function update_activitylog($servicecall_id)
    {

        $model=Servicecall::findOne($servicecall_id);

        $activity_log = trim($model->activity_log);

        if ($activity_log == '') {
            $activity_log_array = array();
        }///end of if ($activity_log=='')
        else {
            $activity_log_array = json_decode($activity_log, true);
        }/////end of else ($activity_log=='')

        $log = array();
        $log['time'] = Handyfunctions::get_datetimestamp();
        $log['jobstatus'] = $model->jobstatus->html_name;
        $log['engineer'] = $model->engineer->company . ', ' . $model->engineer->fullname;
        $log['user'] = Yii::$app->user->identity->name;

        array_push($activity_log_array, $log);

        return self::updateAll(['activity_log' => json_encode($activity_log_array)],['id'=>$model->id]);

    }//end of public function writeactivitylog($this->activity_log);



    /**
     * @param $job_status_id
     * @param $servicecall_id
     * @return bool
     */

    public static function update_jobstatus($job_status_id, $servicecall_id)
    {

        $status_update=Servicecall::updateAll(['job_status_id' => $job_status_id],['id'=>$servicecall_id]);

        if ($status_update)
        {
            $log=Servicecall::update_activitylog($servicecall_id);
            return $log ;
        }
        else
        {
            return false;
        }


    }//end of public function writeactivitylog($this->activity_log);


    public static function get_servicecalls_by_job_status_id($job_status_id)
    {
        return self::findAll(['job_status_id' => $job_status_id]);
    }

}
