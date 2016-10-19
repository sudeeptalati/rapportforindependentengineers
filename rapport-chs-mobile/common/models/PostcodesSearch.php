<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Postcodes;

/**
 * PostcodesSearch represents the model behind the search form about `common\models\Postcodes`.
 */
class PostcodesSearch extends Postcodes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['postcode_id', 'p_x', 'p_y', 'roundrobin'], 'integer'],
            [['postcode_s'], 'safe'],
            [['old_latitude', 'old_longitude'], 'number'],
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
        $query = Postcodes::find();

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
            'postcode_id' => $this->postcode_id,
            'p_x' => $this->p_x,
            'p_y' => $this->p_y,
            'old_latitude' => $this->old_latitude,
            'old_longitude' => $this->old_longitude,
            'roundrobin' => $this->roundrobin,
        ]);

        $query->andFilterWhere(['like', 'postcode_s', $this->postcode_s]);

        return $dataProvider;
    }
}
