<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Enggdiary;

/**
 * EnggdiarySearch represents the model behind the search form about `common\models\Enggdiary`.
 */
class EnggdiarySearch extends Enggdiary
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'engineer_id', 'slots', 'servicecall_id', 'user_id', 'status'], 'integer'],
            [['visit_start_date', 'visit_end_date', 'created', 'modified', 'notes'], 'safe'],
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
        $query = Enggdiary::find();

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
            'engineer_id' => $this->engineer_id,
            'visit_start_date' => $this->visit_start_date,
            'visit_end_date' => $this->visit_end_date,
            'slots' => $this->slots,
            'servicecall_id' => $this->servicecall_id,
            'user_id' => $this->user_id,
            'created' => $this->created,
            'modified' => $this->modified,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }

    public function appointmentsfordateforengineer($engineer_id, $date)
    {

        $date_start_int=strtotime($date.'00:00:00 ');
        $date_end_int=strtotime($date.'23:59:00 ');

        return Enggdiary::find()
            ->where(['between', 'visit_start_date', $date_start_int, $date_end_int])
            ->andWhere(['engineer_id'=> $engineer_id])
            ->orderBy('visit_start_date ASC')
            ->all();
    }







}
