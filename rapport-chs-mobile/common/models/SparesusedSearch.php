<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Sparesused;

/**
 * SparesusedSearch represents the model behind the search form about `common\models\Sparesused`.
 */
class SparesusedSearch extends Sparesused
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'master_item_id', 'servicecall_id', 'quantity', 'created_by_user', 'used'], 'integer'],
            [['item_name', 'part_number', 'date_ordered', 'created', 'modified', 'notes'], 'safe'],
            [['unit_price', 'total_price'], 'number'],
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
        $query = Sparesused::find();

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
            'master_item_id' => $this->master_item_id,
            'servicecall_id' => $this->servicecall_id,
            'unit_price' => $this->unit_price,
            'quantity' => $this->quantity,
            'total_price' => $this->total_price,
            'date_ordered' => $this->date_ordered,
            'created' => $this->created,
            'modified' => $this->modified,
            'created_by_user' => $this->created_by_user,
            'used' => $this->used,
        ]);

        $query->andFilterWhere(['like', 'item_name', $this->item_name])
            ->andFilterWhere(['like', 'part_number', $this->part_number])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
