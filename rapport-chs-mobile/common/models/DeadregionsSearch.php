<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Deadregions;

/**
 * DeadregionsSearch represents the model behind the search form about `common\models\Deadregions`.
 */
class DeadregionsSearch extends Deadregions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dead_id', 'product_id', 'manufacturer_id', 'resolved'], 'integer'],
            [['postcode', 'postcode_s', 'postcode_e', 'ip_address', 'date_logged'], 'safe'],
            [['latitude', 'longitude'], 'number'],
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
        $query = Deadregions::find();

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
            'dead_id' => $this->dead_id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'product_id' => $this->product_id,
            'manufacturer_id' => $this->manufacturer_id,
            'resolved' => $this->resolved,
            'date_logged' => $this->date_logged,
        ]);

        $query->andFilterWhere(['like', 'postcode', $this->postcode])
            ->andFilterWhere(['like', 'postcode_s', $this->postcode_s])
            ->andFilterWhere(['like', 'postcode_e', $this->postcode_e])
            ->andFilterWhere(['like', 'ip_address', $this->ip_address]);

        $query->orderBy(['date_logged' => SORT_DESC]);
        return $dataProvider;
    }
}
