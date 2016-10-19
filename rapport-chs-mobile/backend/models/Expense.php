<?php

namespace backend\models;

use Yii;
use yii\gii\generators\model;

/**
 * This is the model class for table "expense".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $reference_number
 * @property string $expense_title
 * @property string $from_date
 * @property string $to_date
 * @property integer $status_id
 * @property string $submission_date
 * @property string $approval_date
 * @property integer $approved_by
 * @property double $previous_balance
 * @property double $total_spend
 * @property double $amount_reimbursed
 * @property string $created
 * @property string $modified
 * @property string $notes
 */
class Expense extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'expense';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'reference_number', 'expense_title', 'from_date', 'to_date', 'status_id', 'notes'], 'required'],
            [['user_id', 'reference_number', 'status_id', 'approved_by'], 'integer'],
            [['expense_title', 'notes'], 'string'],
            [['from_date', 'to_date', 'submission_date', 'approval_date', 'created', 'modified'], 'safe'],
            [['previous_balance', 'total_spend', 'amount_reimbursed'], 'number'],
        ];
    }


    /**
     * @relations return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    public function getUserFullname() {
        return $this->user->name;
    }

    public function getApprovedby()
    {
        return $this->hasOne(User::className(), ['id' => 'approved_by']);
    }


    public function getApprovedbyName() {

        if (empty($this->approvedby))
            return "";
        else
            return $this->approvedby->name;
    }





    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    public function getStatusName() {
        return $this->status->html_name;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'reference_number' => 'Reference Number',
            'expense_title' => 'Expense Title',
            'from_date' => 'From Date',
            'to_date' => 'To Date',
            'status_id' => 'Status Id',
            'submission_date' => 'Submission Date',
            'approval_date' => 'Approval Date',
            'approved_by' => 'Approved By',
            'previous_balance' => 'Balance ₹',
            'total_spend' => 'Total ₹ ',
            'amount_reimbursed' => 'Reimburse ₹',
            'created' => 'Created',
            'modified' => 'Updated',
            'notes' => 'Notes / Reason',
        ];
    }
}
