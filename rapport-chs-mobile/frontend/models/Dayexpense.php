<?php

namespace frontend\models;

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
            [['total_expense', 'expense_id', 'user_id','reason', 'date_of_spend', 'spend_for_company'], 'required'],
            [['date_of_spend', 'created', 'modified'], 'safe'],
            [['reason', 'spend_for_company', 'company_address', 'travel_from', 'travel_to', 'travel_mode', 'accomodation_details', 'other_expense_details'], 'string'],
            [['total_travel_expense', 'accomodation_expense', 'breakfast_expense', 'lunch_expense', 'dinner_expense', 'other_expense_amount', 'total_expense'], 'number'],
        ];
    }


    /**
     * @relations return \yii\db\ActiveQuery
     */
    public function getExpense()
    {
        return $this->hasOne(Expense::className(), ['id' => 'expense_id']);
    }


    /**
     * @inheritdoc
     */
    public function afterSave($insert)
    {
        $this->addtotalexpensestomainform();
        if (parent::beforeSave($insert)) {
            // Place your custom code here
            return true;
        } else {

            return false;
        }
    }//end of before save



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '		',
            'expense_id' => 'Expense ID',
            'user_id' => 'User',
            'date_of_spend' => 'Date of Spend',
            'reason' => 'Reason',
            'spend_for_company' => 'Company',
            'company_address' => 'Company Address',
            'travel_from' => 'Travel From',
            'travel_to' => 'Travel To',
            'travel_mode' => 'Travel Mode ',
            'total_travel_expense' => 'Total Travel Expense  ₹',
            'accomodation_details' => 'Accomodation Details',
            'accomodation_expense' => 'Accomodation Expense  ₹',
            'breakfast_expense' => 'Breakfast  ₹',
            'lunch_expense' => 'Lunch  ₹',
            'dinner_expense' => 'Dinner  ₹',
            'other_expense_details' => 'Other Expense',
            'other_expense_amount' => 'Other Expense Amount  ₹',
            'total_expense' => 'Total Expense  ₹',
            'created' => 'Created',
            'modified' => 'Updated',
        ];
    }


    public function addtotalexpensestomainform()
    {
        $expenseModel=$this->findExpenseModel($this->expense_id);

        $dayexpenses= Dayexpense::find()->where(['expense_id' => $this->expense_id, ])->all();

        $netspend='';

        echo "expense_id".$this->expense_id;
        echo "count".count($dayexpenses);

        foreach($dayexpenses as $day)
        {
            echo "<hr>".$day->total_expense;
            $netspend=$netspend+$day->total_expense;
        }

        echo "netspend".$netspend;

        $expenseModel->total_spend=$netspend;

        if ($expenseModel->save())
            return true;
        else
            throw new NotFoundHttpException('Could not update expenses. Please contact support.');

    }


    public function findExpenseModel($expense_id)
    {
        if (($expenseModel = Expense::findOne($expense_id)) !== null) {
            return $expenseModel ;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
