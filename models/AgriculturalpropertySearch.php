<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Agriculturalproperty;

/**
 * AgriculturalpropertySearch represents the model behind the search form about `app\models\Agriculturalproperty`.
 */
class AgriculturalpropertySearch extends Agriculturalproperty
{
    public $min_rate_price;
    public $max_rate_price;

    public $min_rent_price;
    public $max_rent_price;

    public $min_area;
    public $max_area;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'location_id', 'city_id', 'added_by', 'updated_by', 'reminder_days', 'publish_on_web', 'status'], 'integer'],
            [['property_id', 'property_by', 'available_for', 'property_type', 'property_area', 'property_unit', 'amenities', 'expected_rate', 'rate_currency', 'expected_rent', 'rent_currency', 'deposit', 'deposit_currency', 'othercharges_currency', 'electric_supply', 'description_ES', 'water_supply', 'description_WS', 'contact_person_name', 'mobile_no', 'email_id', 'profile_photo', 'photos_link', 'address_in_proposal', 'description', 'ideal_for', 'connectivity', 'property_profile_photo', 'gallery_images', 'added_on', 'updated_on', 'close_through', 'reason', 'agreement_date', 'locking_period_date', 'end_date', 'remark', 'buyer_details', 'buy_date','expected_rate_comp','expected_rent_comp','deposit_comp'], 'safe'],
            [['othercharges'], 'number'],
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
        $query = Agriculturalproperty::find();

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
            'location_id' => $this->location_id,
            'city_id' => $this->city_id,
            'othercharges' => $this->othercharges,
            'added_on' => $this->added_on,
            'added_by' => $this->added_by,
            'updated_on' => $this->updated_on,
            'updated_by' => $this->updated_by,
            'agreement_date' => $this->agreement_date,
            'locking_period_date' => $this->locking_period_date,
            'end_date' => $this->end_date,
            'reminder_days' => $this->reminder_days,
            'buy_date' => $this->buy_date,
            'publish_on_web' => $this->publish_on_web,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'property_id', $this->property_id])
            ->andFilterWhere(['like', 'property_by', $this->property_by])
            ->andFilterWhere(['like', 'available_for', $this->available_for])
            ->andFilterWhere(['like', 'property_type', $this->property_type])
            ->andFilterWhere(['like', 'property_area', $this->property_area])
            ->andFilterWhere(['like', 'property_unit', $this->property_unit])
            ->andFilterWhere(['like', 'amenities', $this->amenities])
            ->andFilterWhere(['like', 'expected_rate', $this->expected_rate])
            ->andFilterWhere(['like', 'rate_currency', $this->rate_currency])
            ->andFilterWhere(['like', 'expected_rent', $this->expected_rent])
            ->andFilterWhere(['like', 'rent_currency', $this->rent_currency])
            ->andFilterWhere(['like', 'deposit', $this->deposit])
            ->andFilterWhere(['like', 'deposit_currency', $this->deposit_currency])
            ->andFilterWhere(['like', 'othercharges_currency', $this->othercharges_currency])
            ->andFilterWhere(['like', 'electric_supply', $this->electric_supply])
            ->andFilterWhere(['like', 'description_ES', $this->description_ES])
            ->andFilterWhere(['like', 'water_supply', $this->water_supply])
            ->andFilterWhere(['like', 'description_WS', $this->description_WS])
            ->andFilterWhere(['like', 'contact_person_name', $this->contact_person_name])
            ->andFilterWhere(['like', 'mobile_no', $this->mobile_no])
            ->andFilterWhere(['like', 'email_id', $this->email_id])
            ->andFilterWhere(['like', 'profile_photo', $this->profile_photo])
            ->andFilterWhere(['like', 'photos_link', $this->photos_link])
            ->andFilterWhere(['like', 'address_in_proposal', $this->address_in_proposal])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'ideal_for', $this->ideal_for])
            ->andFilterWhere(['like', 'connectivity', $this->connectivity])
            ->andFilterWhere(['like', 'property_profile_photo', $this->property_profile_photo])
            ->andFilterWhere(['like', 'gallery_images', $this->gallery_images])
            ->andFilterWhere(['like', 'close_through', $this->close_through])
            ->andFilterWhere(['like', 'reason', $this->reason])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'buyer_details', $this->buyer_details])
            ->andFilterWhere(['=', 'status', 1])
            ->andFilterWhere(['=', 'publish_on_web', 1])
            ->andFilterWhere(['=', 'city_id', $this->city_id]);

             $query->andFilterWhere(['>', 'expected_rate_comp', $this->min_rate_price])
            ->andFilterWhere(['<', 'expected_rate_comp', $this->max_rate_price]);

            $query->andFilterWhere(['>', 'expected_rent_comp', $this->min_rent_price])
            ->andFilterWhere(['<', 'expected_rent_comp', $this->max_rent_price]);

        return $dataProvider;
    }
}
