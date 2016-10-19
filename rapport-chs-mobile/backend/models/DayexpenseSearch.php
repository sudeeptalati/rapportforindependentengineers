<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Dayexpense;

/**
 * DayexpenseSearch represents the model behind the search form about `backend\models\Dayexpense`.
 */
class DayexpenseSearch extends Dayexpense
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'expense_id', 'user_id'], 'integer'],
            [['date_of_spend', 'reason', 'spend_for_company', 'company_address', 'travel_from', 'travel_to', 'travel_mode', 'accomodation_details', 'other_expense_details', 'created', 'modified'], 'safe'],
            [['total_travel_expense', 'accomodation_expense', 'breakfast_expense', 'lunch_expense', 'dinner_expense', 'other_expense_amount', 'total_expense'], 'number'],
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
        $query = Dayexpense::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'expense_id' => $this->expense_id,
            'user_id' => $this->user_id,
            'date_of_spend' => $this->date_of_spend,
            'total_travel_expense' => $this->total_travel_expense,
            'accomodation_expense' => $this->accomodation_expense,
            'breakfast_expense' => $this->breakfast_expense,
            'lunch_expense' => $this->lunch_expense,
            'dinner_expense' => $this->dinner_expense,
            'other_expense_amount' => $this->other_expense_amount,
            'total_expense' => $this->total_expense,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'reason', $this->reason])
            ->andFilterWhere(['like', 'spend_for_company', $this->spend_for_company])
            ->andFilterWhere(['like', 'company_address', $this->company_address])
            ->andFilterWhere(['like', 'travel_from', $this->travel_from])
            ->andFilterWhere(['like', 'travel_to', $this->travel_to])
            ->andFilterWhere(['like', 'travel_mode', $this->travel_mode])
            ->andFilterWhere(['like', 'accomodation_details', $this->accomodation_details])
            ->andFilterWhere(['like', 'other_expense_details', $this->other_expense_details]);

        return $dataProvider;
    }
}
