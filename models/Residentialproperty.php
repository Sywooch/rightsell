<?php

namespace app\models;

use Yii;
//use app\models\Area;
//use app\models\City;
//use app\models\Bhk;

/**
 * This is the model class for table "tbl_residentialproperty".
 *
 * @property integer $id
 * @property string $property_id
 * @property string $property_by
 * @property string $available_for
 * @property integer $location_id
 * @property string $property_type
 * @property string $builtup_area
 * @property string $builtup_unit
 * @property string $carpet_area
 * @property string $carpet_unit
 * @property integer $bhk
 * @property string $other
 * @property string $other_bhk
 * @property integer $society_id
 * @property integer $city_id
 * @property integer $area_id
 * @property string $building_name
 * @property string $age_of_building
 * @property string $flat_no
 * @property string $total_no_of_floors
 * @property string $floor_no
 * @property string $facing
 * @property string $furnished
 * @property integer $lift_facility
 * @property string $amenities
 * @property string $expected_rate
 * @property string $rate_currency
 * @property string $rent_currency
 * @property string $deposit_currency
 * @property string $expected_rent
 * @property string $deposit
 * @property string $available_from
 * @property string $agreement_period
 * @property string $is_parking_available
 * @property string $parking_structure
 * @property string $no_of_parking
 * @property string $covered_no
 * @property string $open_no
 * @property string $company_name
 * @property string $contact_person_name
 * @property string $mobile_no
 * @property string $email_id
 * @property string $other_details
 * @property string $key_arrangements
 * @property string $profile_photo
 * @property string $photos_link
 * @property string $video_link
 * @property string $other_property_details
 * @property string $address_in_proposal
 * @property integer $bathroom
 * @property integer $balcony
 * @property string $price_negotiable
 * @property string $spl_attraction
 * @property string $property_profile_photo
 * @property string $gallery_images
 * @property string $property_video_link
 * @property string $maintenance_cost
 * @property double $maintenance_price
 * @property string $unit
 * @property string $preferred_tenants
 * @property string $available_rooms
 * @property string $tenant_profiling
 * @property string $tenant_profiling_desc
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
 * @property integer $min_price
 * @property integer $max_price
 *
 * @property TblResidentialenquiryProposallog[] $tblResidentialenquiryProposallogs
 */
class Residentialproperty extends \yii\db\ActiveRecord
{
    public $min_price;
    public $max_price;
    public $locationname;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_residentialproperty';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['property_id', 'available_for', 'location_id', 'property_type', 'city_id', 'expected_rate', 'rate_currency', 'rent_currency', 'deposit_currency', 'expected_rent', 'deposit', 'agreement_period', 'is_parking_available', 'company_name', 'contact_person_name', 'other_details', 'price_negotiable', 'added_on', 'added_by'], 'required'],
            [['available_for', 'property_type', 'facing', 'furnished', 'amenities', 'is_parking_available', 'email_id', 'address_in_proposal', 'price_negotiable', 'maintenance_cost', 'preferred_tenants', 'remark', 'buyer_details'], 'string'],
            [['location_id', 'bhk', 'society_id', 'city_id', 'area_id', 'lift_facility', 'bathroom', 'balcony', 'added_by', 'updated_by', 'reminder_days', 'publish_on_web', 'status','min_price','max_price'], 'integer'],
            [['available_from', 'added_on', 'updated_on', 'agreement_date', 'locking_period_date', 'end_date', 'buy_date','min_price','max_price'], 'safe'],
            [['maintenance_price'], 'number'],
            [['property_id', 'builtup_area', 'carpet_area', 'other', 'other_bhk', 'expected_rate', 'mobile_no', 'other_details', 'photos_link', 'video_link', 'other_property_details', 'spl_attraction', 'property_profile_photo', 'gallery_images', 'property_video_link', 'available_rooms', 'tenant_profiling', 'tenant_profiling_desc'], 'string', 'max' => 255],
            [['property_by'], 'string', 'max' => 11],
            [['builtup_unit', 'carpet_unit'], 'string', 'max' => 10],
            [['building_name', 'age_of_building', 'flat_no', 'total_no_of_floors', 'floor_no', 'deposit', 'agreement_period', 'parking_structure', 'no_of_parking', 'covered_no', 'open_no'], 'string', 'max' => 24],
            [['rate_currency', 'rent_currency', 'deposit_currency', 'unit'], 'string', 'max' => 15],
            [['expected_rent', 'company_name', 'profile_photo'], 'string', 'max' => 125],
            [['contact_person_name'], 'string', 'max' => 128],
            [['key_arrangements'], 'string', 'max' => 48],
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
            'property_type' => 'Property Type',
            'builtup_area' => 'Builtup Area',
            'builtup_unit' => 'Builtup Unit',
            'carpet_area' => 'Carpet Area',
            'carpet_unit' => 'Carpet Unit',
            'bhk' => 'Bhk',
            'other' => 'Other',
            'other_bhk' => 'Other Bhk',
            'society_id' => 'Society ID',
            'city_id' => 'City ID',
            'area_id' => 'Area ID',
            'building_name' => 'Building Name',
            'age_of_building' => 'Age Of Building',
            'flat_no' => 'Flat No',
            'total_no_of_floors' => 'Total No Of Floors',
            'floor_no' => 'Floor No',
            'facing' => 'Facing',
            'furnished' => 'Furnished',
            'lift_facility' => 'Lift Facility',
            'amenities' => 'Amenities',
            'expected_rate' => 'Expected Rate',
            'rate_currency' => 'Rate Currency',
            'rent_currency' => 'Rent Currency',
            'deposit_currency' => 'Deposit Currency',
            'expected_rent' => 'Expected Rent',
            'deposit' => 'Deposit',
            'available_from' => 'Available From',
            'agreement_period' => 'Agreement Period',
            'is_parking_available' => 'Is Parking Available',
            'parking_structure' => 'Parking Structure',
            'no_of_parking' => 'No Of Parking',
            'covered_no' => 'Covered No',
            'open_no' => 'Open No',
            'company_name' => 'Company Name',
            'contact_person_name' => 'Contact Person Name',
            'mobile_no' => 'Mobile No',
            'email_id' => 'Email ID',
            'other_details' => 'Other Details',
            'key_arrangements' => 'Key Arrangements',
            'profile_photo' => 'Profile Photo',
            'photos_link' => 'Photos Link',
            'video_link' => 'Video Link',
            'other_property_details' => 'Other Property Details',
            'address_in_proposal' => 'Address In Proposal',
            'bathroom' => 'Bathroom',
            'balcony' => 'Balcony',
            'price_negotiable' => 'Price Negotiable',
            'spl_attraction' => 'Spl Attraction',
            'property_profile_photo' => 'Property Profile Photo',
            'gallery_images' => 'Gallery Images',
            'property_video_link' => 'Property Video Link',
            'maintenance_cost' => 'Maintenance Cost',
            'maintenance_price' => 'Maintenance Price',
            'unit' => 'Unit',
            'preferred_tenants' => 'Preferred Tenants',
            'available_rooms' => 'Available Rooms',
            'tenant_profiling' => 'Tenant Profiling',
            'tenant_profiling_desc' => 'Tenant Profiling Desc',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblResidentialenquiryProposallogs()
    {
        return $this->hasMany(TblResidentialenquiryProposallog::className(), ['residential_property_id' => 'id']);
    }

    public function getArea()
    {
        return $this->hasOne(Area::className(), ['id' => 'area_id']);
    }

    public function getBhks()
    {
        return $this->hasOne(Bhk::className(), ['id' => 'bhk']);
    }

    public function getLocations()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }

    public function getCityName()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
}
