<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Residentialproperty;

/**
 * ResidentialpropertyTestVisSearch represents the model behind the search form about `app\models\Residentialproperty`.
 */
class ResidentialpropertyTestVisSearch extends Residentialproperty
{
    public $location_id_arr=[];
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','bhk', 'society_id', 'city_id', 'area_id', 'lift_facility', 'bathroom', 'balcony', 'added_by', 'updated_by', 'reminder_days', 'publish_on_web', 'status', 'expected_rate_comp', 'expected_rent_comp', 'deposit_comp'], 'integer'],
            [['property_id', 'property_by', 'available_for', 'property_type', 'builtup_area', 'builtup_unit', 'carpet_area', 'carpet_unit', 'other', 'other_bhk', 'building_name', 'age_of_building', 'flat_no', 'total_no_of_floors', 'floor_no', 'facing', 'furnished', 'amenities', 'expected_rate', 'rate_currency', 'rent_currency', 'deposit_currency', 'expected_rent', 'deposit', 'available_from', 'agreement_period', 'is_parking_available', 'parking_structure', 'no_of_parking', 'covered_no', 'open_no', 'company_name', 'contact_person_name', 'mobile_no', 'email_id', 'other_details', 'key_arrangements', 'profile_photo', 'photos_link', 'video_link', 'other_property_details', 'address_in_proposal', 'price_negotiable', 'spl_attraction', 'property_profile_photo', 'gallery_images', 'property_video_link', 'maintenance_cost', 'unit', 'preferred_tenants', 'available_rooms', 'tenant_profiling', 'tenant_profiling_desc', 'added_on', 'updated_on', 'close_through', 'reason', 'agreement_date', 'locking_period_date', 'end_date', 'remark', 'buyer_details', 'buy_date','location_id'], 'safe'],
            [['maintenance_price'], 'number'],
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
        $query = Residentialproperty::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $this->location_id_arr = [];
        if(isset($this->location_id))
        {
            $this->location_id_arr = explode(", ", $this->location_id);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'location_id' => $this->location_id_arr,
            'bhk' => $this->bhk,
            'society_id' => $this->society_id,
            'city_id' => $this->city_id,
            'area_id' => $this->area_id,
            'lift_facility' => $this->lift_facility,
            'available_from' => $this->available_from,
            'bathroom' => $this->bathroom,
            'balcony' => $this->balcony,
            'maintenance_price' => $this->maintenance_price,
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
            'expected_rate_comp' => $this->expected_rate_comp,
            'expected_rent_comp' => $this->expected_rent_comp,
            'deposit_comp' => $this->deposit_comp,
        ]);

        $query->andFilterWhere(['like', 'property_id', $this->property_id])
            ->andFilterWhere(['like', 'property_by', $this->property_by])
            ->andFilterWhere(['in', 'location_id', $this->location_id_arr])
            ->andFilterWhere(['like', 'available_for', $this->available_for])
            ->andFilterWhere(['like', 'property_type', $this->property_type])
            ->andFilterWhere(['like', 'builtup_area', $this->builtup_area])
            ->andFilterWhere(['like', 'builtup_unit', $this->builtup_unit])
            ->andFilterWhere(['like', 'carpet_area', $this->carpet_area])
            ->andFilterWhere(['like', 'carpet_unit', $this->carpet_unit])
            ->andFilterWhere(['like', 'other', $this->other])
            ->andFilterWhere(['like', 'other_bhk', $this->other_bhk])
            ->andFilterWhere(['like', 'building_name', $this->building_name])
            ->andFilterWhere(['like', 'age_of_building', $this->age_of_building])
            ->andFilterWhere(['like', 'flat_no', $this->flat_no])
            ->andFilterWhere(['like', 'total_no_of_floors', $this->total_no_of_floors])
            ->andFilterWhere(['like', 'floor_no', $this->floor_no])
            ->andFilterWhere(['like', 'facing', $this->facing])
            ->andFilterWhere(['like', 'furnished', $this->furnished])
            ->andFilterWhere(['like', 'amenities', $this->amenities])
            ->andFilterWhere(['like', 'expected_rate', $this->expected_rate])
            ->andFilterWhere(['like', 'rate_currency', $this->rate_currency])
            ->andFilterWhere(['like', 'rent_currency', $this->rent_currency])
            ->andFilterWhere(['like', 'deposit_currency', $this->deposit_currency])
            ->andFilterWhere(['like', 'expected_rent', $this->expected_rent])
            ->andFilterWhere(['like', 'deposit', $this->deposit])
            ->andFilterWhere(['like', 'agreement_period', $this->agreement_period])
            ->andFilterWhere(['like', 'is_parking_available', $this->is_parking_available])
            ->andFilterWhere(['like', 'parking_structure', $this->parking_structure])
            ->andFilterWhere(['like', 'no_of_parking', $this->no_of_parking])
            ->andFilterWhere(['like', 'covered_no', $this->covered_no])
            ->andFilterWhere(['like', 'open_no', $this->open_no])
            ->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'contact_person_name', $this->contact_person_name])
            ->andFilterWhere(['like', 'mobile_no', $this->mobile_no])
            ->andFilterWhere(['like', 'email_id', $this->email_id])
            ->andFilterWhere(['like', 'other_details', $this->other_details])
            ->andFilterWhere(['like', 'key_arrangements', $this->key_arrangements])
            ->andFilterWhere(['like', 'profile_photo', $this->profile_photo])
            ->andFilterWhere(['like', 'photos_link', $this->photos_link])
            ->andFilterWhere(['like', 'video_link', $this->video_link])
            ->andFilterWhere(['like', 'other_property_details', $this->other_property_details])
            ->andFilterWhere(['like', 'address_in_proposal', $this->address_in_proposal])
            ->andFilterWhere(['like', 'price_negotiable', $this->price_negotiable])
            ->andFilterWhere(['like', 'spl_attraction', $this->spl_attraction])
            ->andFilterWhere(['like', 'property_profile_photo', $this->property_profile_photo])
            ->andFilterWhere(['like', 'gallery_images', $this->gallery_images])
            ->andFilterWhere(['like', 'property_video_link', $this->property_video_link])
            ->andFilterWhere(['like', 'maintenance_cost', $this->maintenance_cost])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'preferred_tenants', $this->preferred_tenants])
            ->andFilterWhere(['like', 'available_rooms', $this->available_rooms])
            ->andFilterWhere(['like', 'tenant_profiling', $this->tenant_profiling])
            ->andFilterWhere(['like', 'tenant_profiling_desc', $this->tenant_profiling_desc])
            ->andFilterWhere(['like', 'close_through', $this->close_through])
            ->andFilterWhere(['like', 'reason', $this->reason])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['=', 'city_id', $this->city_id])
            ->andFilterWhere(['=', 'status', 1])
            ->andFilterWhere(['like', 'buyer_details', $this->buyer_details]);

        return $dataProvider;
    }
}
