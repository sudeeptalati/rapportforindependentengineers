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
            [['insurer_reference_number', 'fault_code', 'fault_description', 'work_carried_out', 'notes', 'activity_log', 'comments', 'work_summary'], 'string'],
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

            /*
            'id' => Yii::t('app', 'ID'),
            'service_reference_number' => Yii::t('app', 'Service Reference Number'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'contract_id' => Yii::t('app', 'Contract ID'),
            'engineer_id' => Yii::t('app', 'Engineer ID'),
            'insurer_reference_number' => Yii::t('app', 'Insurer Reference Number'),
            'job_status_id' => Yii::t('app', 'Job Status ID'),
            'fault_date' => Yii::t('app', 'Fault Date'),
            'fault_code' => Yii::t('app', 'Fault Code'),
            'fault_description' => Yii::t('app', 'Issue Reported '),
            'engg_diary_id' => Yii::t('app', 'Engg Diary ID'),
            'work_carried_out' => Yii::t('app', 'Work Carried Out'),
            'spares_used_status_id' => Yii::t('app', 'Spares Used Status ID'),
            'total_cost' => Yii::t('app', 'Total Cost'),
            'vat_on_total' => Yii::t('app', 'Vat On Total'),
            'net_cost' => Yii::t('app', 'Net Cost'),
            'job_payment_date' => Yii::t('app', 'Job Payment Date'),
            'job_finished_date' => Yii::t('app', 'Job Finished Date'),
            'notes' => Yii::t('app', 'Notes'),
            'created_by_user_id' => Yii::t('app', 'Created By User ID'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
            'cancelled' => Yii::t('app', 'Cancelled'),
            'closed' => Yii::t('app', 'Closed'),
            'number_of_visits' => Yii::t('app', 'Number Of Visits'),
            'activity_log' => Yii::t('app', 'Activity Log'),
            'comments' => Yii::t('app', 'Comments'),
            'recalled_job' => Yii::t('app', 'Recalled Job'),
            'work_summary' => Yii::t('app', 'Work Summary'),

            */
            'id' => 'ID',
            'service_reference_number' => 'Job Ref. No#',
            'customer_id' => 'Customer',
            'product_id' => 'Product',
            'contract_id' => 'Job Type',
            'engineer_id' => 'Servicecall Engineer',
            'insurer_reference_number' => 'Insurer Reference No#',
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
            'notes' => 'Ω BER Authority No. / Test Results / Booking Time , etc',
            'created_by_user_id' => 'Created By User',
            'created' => 'Created',
            'modified' => 'Modified',
            'cancelled' => 'Cancelled',
            'closed' => 'Closed',
            'comments' => 'Comments ',
            'work_summary' => 'Work Summary',

            ///Custom Labels
            'contract' => 'Contract',

        ];
    }



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

    public static function update_jobstatus($job_status_id, $servicecall_id)
    {

        if (Servicecall::updateAll(['job_status_id' => $job_status_id],['id'=>$servicecall_id]))
            return Servicecall::update_activitylog($servicecall_id);
        else
            return false;

    }//end of public function writeactivitylog($this->activity_log);






}
