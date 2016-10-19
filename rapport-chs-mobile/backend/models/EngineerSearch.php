<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Engineer;

/**
 * EngineerSearch represents the model behind the search form about `common\models\Engineer`.
 */
class EngineerSearch extends Engineer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'company_type_id', 'wta_member', 'wta_associate_member', 'weight', 'on_holiday', 'published', 'ordering', 'staffted_office', 'accept_contracts', 'accept_spot_contracts', 'phoneclicks', 'enquiryclicks', 'impressions'], 'integer'],
            [[ 'name', 'wta_membership_number', 'wta_membership_expiry_date', 'line_1', 'line_2', 'line_3', 'town', 'county', 'postcode_s', 'postcode_e', 'email', 'phone', 'cell', 'fax', 'blurb', 'web_site', 'unverified_email', 'comments', 'business_principle', 'total_employees', 'total_engineers', 'average_response_time', 'average_turnover', 'company_reg_number', 'vat_number', 'working_premises', 'accounts_contact_person', 'accounts_contact_address', 'accounts_telephone', 'accounts_email', 'created', 'modified'], 'safe'],
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
        $query = Engineer::find();

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
            'user_id' => $this->user_id,
            'company_type_id' => $this->company_type_id,
            'wta_member' => $this->wta_member,
            'wta_associate_member' => $this->wta_associate_member,
            'wta_membership_expiry_date' => $this->wta_membership_expiry_date,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'weight' => $this->weight,
            'on_holiday' => $this->on_holiday,
            'published' => $this->published,
            'ordering' => $this->ordering,
            'staffted_office' => $this->staffted_office,
            'accept_contracts' => $this->accept_contracts,
            'accept_spot_contracts' => $this->accept_spot_contracts,
            'created' => $this->created,
            'modified' => $this->modified,
            'phoneclicks' => $this->phoneclicks,
            'enquiryclicks' => $this->enquiryclicks,
            'impressions' => $this->impressions,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'wta_membership_number', $this->wta_membership_number])
            ->andFilterWhere(['like', 'line_1', $this->line_1])
            ->andFilterWhere(['like', 'line_2', $this->line_2])
            ->andFilterWhere(['like', 'line_3', $this->line_3])
            ->andFilterWhere(['like', 'town', $this->town])
            ->andFilterWhere(['like', 'county', $this->county])
            ->andFilterWhere(['like', 'postcode_s', $this->postcode_s])
            ->andFilterWhere(['like', 'postcode_e', $this->postcode_e])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'cell', $this->cell])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'blurb', $this->blurb])
            ->andFilterWhere(['like', 'web_site', $this->web_site])
            ->andFilterWhere(['like', 'unverified_email', $this->unverified_email])
            ->andFilterWhere(['like', 'comments', $this->comments])
            ->andFilterWhere(['like', 'business_principle', $this->business_principle])
            ->andFilterWhere(['like', 'total_employees', $this->total_employees])
            ->andFilterWhere(['like', 'total_engineers', $this->total_engineers])
            ->andFilterWhere(['like', 'average_response_time', $this->average_response_time])
            ->andFilterWhere(['like', 'average_turnover', $this->average_turnover])
            ->andFilterWhere(['like', 'company_reg_number', $this->company_reg_number])
            ->andFilterWhere(['like', 'vat_number', $this->vat_number])
            ->andFilterWhere(['like', 'working_premises', $this->working_premises])
            ->andFilterWhere(['like', 'accounts_contact_person', $this->accounts_contact_person])
            ->andFilterWhere(['like', 'accounts_contact_address', $this->accounts_contact_address])
            ->andFilterWhere(['like', 'accounts_telephone', $this->accounts_telephone])
            ->andFilterWhere(['like', 'accounts_email', $this->accounts_email]);

        return $dataProvider;
    }
}
