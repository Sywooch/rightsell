<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_agriculturalproperty".
 *
 * @property integer $id
 * @property string $property_id
 * @property string $property_by
 * @property string $available_for
 * @property integer $location_id
 * @property integer $city_id
 * @property string $property_type
 * @property string $property_area
 * @property string $property_unit
 * @property string $amenities
 * @property string $expected_rate
 * @property string $rate_currency
 * @property string $expected_rent
 * @property string $rent_currency
 * @property string $deposit
 * @property double $othercharges
 * @property string $deposit_currency
 * @property string $othercharges_currency
 * @property string $electric_supply
 * @property string $description_ES
 * @property string $water_supply
 * @property string $description_WS
 * @property string $contact_person_name
 * @property string $mobile_no
 * @property string $email_id
 * @property string $profile_photo
 * @property string $photos_link
 * @property string $address_in_proposal
 * @property string $description
 * @property string $ideal_for
 * @property string $connectivity
 * @property string $property_profile_photo
 * @property string $gallery_images
 * @property string $added_on
 * @property integer $added_by
 * @property string $updated_on
 * @property integer $updated_by
 * @property string $close_through
 * @property string $reason
 * @property string $agreement_date
 * @property string $locking_period_date
 * @property string $end_date
 * @property string $remark
 * @property integer $reminder_days
 * @property string $buyer_details
 * @property string $buy_date
 * @property integer $publish_on_web
 * @property integer $status
 */
class Agriculturalproperty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_agriculturalproperty';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['property_id', 'available_for', 'location_id', 'city_id', 'property_type', 'expected_rate', 'rate_currency', 'expected_rent', 'rent_currency', 'deposit', 'deposit_currency', 'electric_supply', 'contact_person_name', 'added_on', 'added_by'], 'required'],
            [['available_for', 'property_type', 'amenities', 'othercharges_currency', 'electric_supply', 'description_ES', 'water_supply', 'description_WS', 'email_id', 'address_in_proposal', 'description', 'ideal_for', 'connectivity', 'remark', 'buyer_details'], 'string'],
            [['location_id', 'city_id', 'added_by', 'updated_by', 'reminder_days', 'publish_on_web', 'status'], 'integer'],
            [['othercharges'], 'number'],
            [['expected_rate_comp','expected_rent_comp','deposit_comp','added_on', 'updated_on', 'agreement_date', 'locking_period_date', 'end_date', 'buy_date'], 'safe'],
            [['property_id', 'property_area', 'expected_rate', 'mobile_no', 'photos_link', 'property_profile_photo', 'gallery_images'], 'string', 'max' => 255],
            [['property_by'], 'string', 'max' => 11],
            [['property_unit'], 'string', 'max' => 10],
            [['rate_currency', 'rent_currency', 'deposit_currency'], 'string', 'max' => 15],
            [['expected_rent', 'profile_photo'], 'string', 'max' => 125],
            [['deposit'], 'string', 'max' => 24],
            [['contact_person_name'], 'string', 'max' => 128],
            [['close_through', 'reason'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'property_id' => 'Property ID',
            'property_by' => 'Property By',
            'available_for' => 'Available For',
            'location_id' => 'Location ID',
            'city_id' => 'City ID',
            'property_type' => 'Property Type',
            'property_area' => 'Property Area',
            'property_unit' => 'Property Unit',
            'amenities' => 'Amenities',
            'expected_rate' => 'Expected Rate',
            'rate_currency' => 'Rate Currency',
            'expected_rent' => 'Expected Rent',
            'rent_currency' => 'Rent Currency',
            'deposit' => 'Deposit',
            'othercharges' => 'Othercharges',
            'deposit_currency' => 'Deposit Currency',
            'othercharges_currency' => 'Othercharges Currency',
            'electric_supply' => 'Electric Supply',
            'description_ES' => 'Description  Es',
            'water_supply' => 'Water Supply',
            'description_WS' => 'Description  Ws',
            'contact_person_name' => 'Contact Person Name',
            'mobile_no' => 'Mobile No',
            'email_id' => 'Email ID',
            'profile_photo' => 'Profile Photo',
            'photos_link' => 'Photos Link',
            'address_in_proposal' => 'Address In Proposal',
            'description' => 'Description',
            'ideal_for' => 'Ideal For',
            'connectivity' => 'Connectivity',
            'property_profile_photo' => 'Property Profile Photo',
            'gallery_images' => 'Gallery Images',
            'added_on' => 'Added On',
            'added_by' => 'Added By',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
            'close_through' => 'Close Through',
            'reason' => 'Reason',
            'agreement_date' => 'Agreement Date',
            'locking_period_date' => 'Locking Period Date',
            'end_date' => 'End Date',
            'remark' => 'Remark',
            'reminder_days' => 'Reminder Days',
            'buyer_details' => 'Buyer Details',
            'buy_date' => 'Buy Date',
            'publish_on_web' => 'Publish On Web',
            'status' => 'Status',
        ];
    }

    public function getLocations()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }

    public function getCityName()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    public function getAmenityies()
    {
        return $this->hasMany(AgriculturalpropertyAmenities::className(), ['property_id' => 'id']);
    }
}
