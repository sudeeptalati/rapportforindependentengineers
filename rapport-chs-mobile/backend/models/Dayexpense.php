<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "dayexpense".
 *
 * @property integer $id
 * @property integer $expense_id
 * @property integer $user_id
 * @property string $date_of_spend
 * @property string $reason
 * @property string $spend_for_company
 * @property string $company_address
 * @property string $travel_from
 * @property string $travel_to
 * @property string $travel_mode
 * @property double $total_travel_expense
 * @property string $accomodation_details
 * @property double $accomodation_expense
 * @property double $breakfast_expense
 * @property double $lunch_expense
 * @property double $dinner_expense
 * @property string $other_expense_details
 * @property double $other_expense_amount
 * @property double $total_expense
 * @property string $created
 * @property string $modified
 */
class Dayexpense extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dayexpense';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['expense_id', 'user_id'], 'integer'],
            [['user_id', 'date_of_spend', 'spend_for_company'], 'required'],
            [['date_of_spend',  'created', 'modified'], 'safe'],
            [['reason', 'spend_for_company', 'company_address', 'travel_from', 'travel_to', 'travel_mode', 'accomodation_details', 'other_expense_details'], 'string'],
            [['total_travel_expense', 'accomodation_expense', 'breakfast_expense', 'lunch_expense', 'dinner_expense', 'other_expense_amount', 'total_expense'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '		',
            'expense_id' => 'Expense ID',
            'user_id' => '	',
            'date_of_spend' => 'Spend From Date',
            'reason' => 'Reason',
            'spend_for_company' => '	',
            'company_address' => 'Company Address',
            'travel_from' => '	',
            'travel_to' => 'Travel To',
            'travel_mode' => 'Travel Mode',
            'total_travel_expense' => 'Total Travel Expense',
            'accomodation_details' => 'Accomodation Details',
            'accomodation_expense' => 'Accomodation Expense',
            'breakfast_expense' => 'Breakfast Expense',
            'lunch_expense' => 'Lunch Expense',
            'dinner_expense' => 'Dinner Expense',
            'other_expense_details' => 'Other Expense Details',
            'other_expense_amount' => 'Other Expense Amount',
            'total_expense' => 'Total Expense',
            'created' => '	',
            'modified' => 'Modified',
        ];
    }
}
