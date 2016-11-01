<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Documentsmanuals;

/**
 * DocumentsmanualsSearch represents the model behind the search form about `common\models\Documentsmanuals`.
 */
class DocumentsmanualsSearch extends Documentsmanuals
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'document_type_id', 'brand_id', 'product_type_id', 'created_by_user_id', 'active'], 'integer'],
            [['name', 'description', 'model_nos', 'created', 'filename', 'version'], 'safe'],
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
        $query = Documentsmanuals::find();

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
            'document_type_id' => $this->document_type_id,
            'brand_id' => $this->brand_id,
            'product_type_id' => $this->product_type_id,
            'created' => $this->created,
            'created_by_user_id' => $this->created_by_user_id,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'model_nos', $this->model_nos])
            ->andFilterWhere(['like', 'filename', $this->filename])
            ->andFilterWhere(['like', 'version', $this->version]);

        return $dataProvider;
    }
}
