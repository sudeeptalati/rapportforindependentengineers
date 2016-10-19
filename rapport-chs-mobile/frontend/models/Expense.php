<?php

namespace frontend\models;

use yii\behaviors\TimestampBehavior;

use yii\db\ActiveRecord;

use Yii;

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
            [['user_id', 'expense_title', 'from_date', 'to_date', 'status_id'], 'required'],
            [['user_id', 'reference_number', 'status_id', 'approved_by'], 'integer'],
            [['expense_title', 'notes'], 'string'],
            [['from_date', 'to_date', 'submission_date', 'approval_date', 'created', 'modified'], 'safe'],
            [['previous_balance', 'total_spend', 'amount_reimbursed'], 'number'],
        ];
    }

    /***
     * @return array
     * @behaviours
     */

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'modified',
                ],
                'value' => function() {
                    return date('Y-m-d h:i:s'); // unix timestamp
                },
            ],
        ];
    }//end of behaviors



    /**
     * @relations return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    public function getStatusName() {
        return $this->status->html_name;
    }

    public function getDayexpenses()
    {
        return $this->hasMany(Dayexpense::className(), ['expense_id' => 'id']);
    }
    public function getDayexpensesCount()
    {
        return $this->hasMany(Dayexpense::className(), ['expense_id' => 'id'])->count('expense_id');
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
            'amount_reimbursed' => 'Reimbursed ₹',
            'created' => 'Created',
            'modified' => 'Updated',
            'notes' => 'Notes',
        ];
    }


    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Place your custom code here
            $this->reference_number=$this->generatenewreferencenumber();
            return true;
        } else {

            return false;
        }
    }//end of before save

    public function generatenewreferencenumber()
    {

        $max = $this::find() // AQ instance
        ->select('max(reference_number)') // we need only one column
        ->scalar(); // cool, huh?
        return $max+1;
    }///end of   public function generatenewreferencenumber()



}
