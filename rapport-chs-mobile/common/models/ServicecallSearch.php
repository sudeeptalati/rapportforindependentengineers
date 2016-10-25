<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Servicecall;

/**
 * ServicecallSearch represents the model behind the search form about `common\models\Servicecall`.
 */
class ServicecallSearch extends Servicecall
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'service_reference_number', 'customer_id', 'product_id', 'contract_id', 'engineer_id', 'job_status_id', 'engg_diary_id', 'spares_used_status_id', 'created_by_user_id', 'number_of_visits', 'recalled_job'], 'integer'],
            [['insurer_reference_number', 'fault_date', 'fault_code', 'fault_description', 'work_carried_out', 'job_payment_date', 'job_finished_date', 'notes', 'created', 'modified', 'cancelled', 'closed', 'activity_log', 'comments', 'work_summary'], 'safe'],
            [['total_cost', 'vat_on_total', 'net_cost'], 'number'],
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
        $query = Servicecall::find();

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
            'service_reference_number' => $this->service_reference_number,
            'customer_id' => $this->customer_id,
            'product_id' => $this->product_id,
            'contract_id' => $this->contract_id,
            'engineer_id' => $this->engineer_id,
            'job_status_id' => $this->job_status_id,
            'fault_date' => $this->fault_date,
            'engg_diary_id' => $this->engg_diary_id,
            'spares_used_status_id' => $this->spares_used_status_id,
            'total_cost' => $this->total_cost,
            'vat_on_total' => $this->vat_on_total,
            'net_cost' => $this->net_cost,
            'job_payment_date' => $this->job_payment_date,
            'job_finished_date' => $this->job_finished_date,
            'created_by_user_id' => $this->created_by_user_id,
            'created' => $this->created,
            'modified' => $this->modified,
            'cancelled' => $this->cancelled,
            'closed' => $this->closed,
            'number_of_visits' => $this->number_of_visits,
            'recalled_job' => $this->recalled_job,
        ]);

        $query->andFilterWhere(['like', 'insurer_reference_number', $this->insurer_reference_number])
            ->andFilterWhere(['like', 'fault_code', $this->fault_code])
            ->andFilterWhere(['like', 'fault_description', $this->fault_description])
            ->andFilterWhere(['like', 'work_carried_out', $this->work_carried_out])
            ->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'activity_log', $this->activity_log])
            ->andFilterWhere(['like', 'comments', $this->comments])
            ->andFilterWhere(['like', 'work_summary', $this->work_summary]);

        return $dataProvider;
    }
}
