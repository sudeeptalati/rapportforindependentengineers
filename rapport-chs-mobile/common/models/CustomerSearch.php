<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Customer;

/**
 * CustomerSearch represents the model behind the search form about `common\models\Customer`.
 */
class CustomerSearch extends Customer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'created_by_user_id', 'lockcode'], 'integer'],
            [['title', 'first_name', 'last_name', 'fullname', 'address_line_1', 'address_line_2', 'address_line_3', 'town', 'postcode_s', 'postcode_e', 'postcode', 'county', 'state', 'country', 'latitudes', 'longitudes', 'telephone', 'mobile', 'fax', 'email', 'notes', 'created', 'modified'], 'safe'],
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
        $query = Customer::find();

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
            'product_id' => $this->product_id,
            'created_by_user_id' => $this->created_by_user_id,
            'created' => $this->created,
            'modified' => $this->modified,
            'lockcode' => $this->lockcode,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'fullname', $this->fullname])
            ->andFilterWhere(['like', 'address_line_1', $this->address_line_1])
            ->andFilterWhere(['like', 'address_line_2', $this->address_line_2])
            ->andFilterWhere(['like', 'address_line_3', $this->address_line_3])
            ->andFilterWhere(['like', 'town', $this->town])
            ->andFilterWhere(['like', 'postcode_s', $this->postcode_s])
            ->andFilterWhere(['like', 'postcode_e', $this->postcode_e])
            ->andFilterWhere(['like', 'postcode', $this->postcode])
            ->andFilterWhere(['like', 'county', $this->county])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'latitudes', $this->latitudes])
            ->andFilterWhere(['like', 'longitudes', $this->longitudes])
            ->andFilterWhere(['like', 'telephone', $this->telephone])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
