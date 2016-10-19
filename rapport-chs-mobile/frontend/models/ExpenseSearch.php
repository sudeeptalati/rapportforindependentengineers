<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Expense;

/**
 * ExpenseSearch represents the model behind the search form about `frontend\models\Expense`.
 */
class ExpenseSearch extends Expense
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'reference_number', 'status_id', 'approved_by'], 'integer'],
            [['expense_title', 'from_date', 'to_date', 'submission_date', 'approval_date', 'created', 'modified', 'notes'], 'safe'],
            [['previous_balance', 'total_spend', 'amount_reimbursed'], 'number'],
        ];
    }






    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Expense::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $loggedinuser = Yii::$app->user->identity;

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $loggedinuser->id,/////We will only display expenses of logged in user
            'reference_number' => $this->reference_number,
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
            'status_id' => $this->status_id,
            'submission_date' => $this->submission_date,
            'approval_date' => $this->approval_date,
            'approved_by' => $this->approved_by,
            'previous_balance' => $this->previous_balance,
            'total_spend' => $this->total_spend,
            'amount_reimbursed' => $this->amount_reimbursed,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'expense_title', $this->expense_title])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        // ... ORDER BY `id` ASC, `name` DESC
        $query->orderBy([

            'created' => SORT_DESC,
        ]);

        return $dataProvider;
    }
}
