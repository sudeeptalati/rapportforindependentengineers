<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProductSearch represents the model behind the search form about `common\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contract_id', 'brand_id', 'product_type_id', 'customer_id', 'engineer_id', 'discontinued', 'warranty_for_months', 'created_by_user_id', 'lockcode'], 'integer'],
            [['purchased_from', 'purchase_date', 'warranty_date', 'model_number', 'serial_number', 'production_code', 'enr_number', 'fnr_number', 'notes', 'created', 'modified', 'cancelled'], 'safe'],
            [['purchase_price'], 'number'],
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
        $query = Product::find();

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
            'contract_id' => $this->contract_id,
            'brand_id' => $this->brand_id,
            'product_type_id' => $this->product_type_id,
            'customer_id' => $this->customer_id,
            'engineer_id' => $this->engineer_id,
            'purchase_date' => $this->purchase_date,
            'warranty_date' => $this->warranty_date,
            'discontinued' => $this->discontinued,
            'warranty_for_months' => $this->warranty_for_months,
            'purchase_price' => $this->purchase_price,
            'created_by_user_id' => $this->created_by_user_id,
            'created' => $this->created,
            'modified' => $this->modified,
            'cancelled' => $this->cancelled,
            'lockcode' => $this->lockcode,
        ]);

        $query->andFilterWhere(['like', 'purchased_from', $this->purchased_from])
            ->andFilterWhere(['like', 'model_number', $this->model_number])
            ->andFilterWhere(['like', 'serial_number', $this->serial_number])
            ->andFilterWhere(['like', 'production_code', $this->production_code])
            ->andFilterWhere(['like', 'enr_number', $this->enr_number])
            ->andFilterWhere(['like', 'fnr_number', $this->fnr_number])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
