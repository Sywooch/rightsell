<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_commercialproperty".
 *
 * @property integer $id
 * @property string $available_for
 * @property string $property_id
 * @property string $type
 * @property integer $location_id
 * @property integer $city_id
 * @property string $sublocation
 * @property string $landmark
 * @property string $building_name
 * @property integer $area
 * @property string $splitted_area
 * @property string $total_no_of_floors
 * @property string $floor_no
 * @property string $office_no
 * @property string $rent_details
 * @property string $rentunit
 * @property string $deposite_details
 * @property string $depositunit
 * @property string $rate_details
 * @property string $rate_details_unit
 * @property string $maintenance_tax
 * @property string $maintenance_tax_unit
 * @property string $service_tax_applicable
 * @property string $service_tax_value
 * @property string $other_charges
 * @property string $other_charges_unit
 * @property string $service_tax_unit
 * @property string $description
 * @property string $furnished
 * @property string $reception
 * @property string $min_workstations
 * @property string $max_workstations
 * @property string $cubicle
 * @property string $cabin
 * @property string $half_cabin
 * @property string $boardroom
 * @property string $conference_room
 * @property string $meeting_room
 * @property string $discussion_room
 * @property string $admin_room
 * @property string $account_room
 * @property string $interview_room
 * @property string $storage_room
 * @property string $ups_room
 * @property string $server_room
 * @property string $hub_room
 * @property string $epabx_room
 * @property string $ahu_room
 * @property string $electrical_room
 * @property string $store_room
 * @property string $pantry
 * @property string $cafeteria
 * @property string $toilets
 * @property string $power_backup
 * @property string $lift_facility
 * @property string $four_wheeler_parking
 * @property string $two_wheeler_parking
 * @property string $outer_power_backup
 * @property string $frontedge
 * @property string $frontedge_height
 * @property string $mezzanine
 * @property string $mezzanine_height
 * @property string $warehouse_height
 * @property string $power_load
 * @property string $open_area
 * @property string $office_shed_area
 * @property string $owners_name
 * @property string $mobile_no
 * @property string $landline_no
 * @property string $email_id
 * @property string $other_details
 * @property string $website_link
 * @property string $proposal_title
 * @property string $commercial_offer
 * @property string $note
 * @property string $lenden_address
 * @property string $picasa_url
 * @property string $facing
 * @property string $ideal_for
 * @property string $available_from
 * @property string $gallery_images
 * @property string $water_availability
 * @property string $photo
 * @property integer $publish_on_web
 * @property string $added_on
 * @property integer $added_by
 * @property string $updated_on
 * @property integer $updated_by
 * @property string $reason
 * @property integer $status
 * @property integer $rate_details_comp
 * @property integer $rent_details_comp
 * @property integer $deposite_details_comp
 *
 * @property TblEnquirylog[] $tblEnquirylogs
 * @property TblPropertyfiles[] $tblPropertyfiles
 */
class Commercialproperty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_commercialproperty';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['available_for', 'type', 'location_id', 'landmark', 'building_name', 'service_tax_applicable', 'furnished', 'mezzanine_height', 'warehouse_height', 'power_load', 'open_area', 'office_shed_area', 'owners_name', 'mobile_no', 'landline_no', 'email_id', 'other_details', 'added_on', 'added_by'], 'required'],
            [['available_for', 'type', 'rentunit', 'depositunit', 'rate_details_unit', 'maintenance_tax_unit', 'service_tax_applicable', 'other_charges_unit', 'furnished', 'mezzanine', 'email_id', 'other_details', 'commercial_offer', 'note', 'lenden_address', 'picasa_url', 'ideal_for', 'water_availability'], 'string'],
            [['location_id', 'city_id', 'area', 'publish_on_web', 'added_by', 'updated_by', 'status', 'rate_details_comp', 'rent_details_comp', 'deposite_details_comp'], 'integer'],
            [['available_from', 'added_on', 'updated_on'], 'safe'],
            [['property_id', 'sublocation', 'landmark', 'building_name', 'splitted_area', 'total_no_of_floors', 'floor_no', 'office_no', 'rent_details', 'deposite_details', 'rate_details', 'maintenance_tax', 'description', 'reception', 'min_workstations', 'max_workstations', 'cubicle', 'cabin', 'half_cabin', 'boardroom', 'conference_room', 'meeting_room', 'discussion_room', 'admin_room', 'account_room', 'interview_room', 'storage_room', 'ups_room', 'server_room', 'hub_room', 'epabx_room', 'ahu_room', 'electrical_room', 'store_room', 'pantry', 'cafeteria', 'toilets', 'power_backup', 'lift_facility', 'four_wheeler_parking', 'outer_power_backup', 'frontedge', 'frontedge_height', 'mezzanine_height', 'warehouse_height', 'power_load', 'open_area', 'office_shed_area', 'owners_name', 'website_link', 'proposal_title', 'gallery_images', 'reason'], 'string', 'max' => 255],
            [['service_tax_value', 'other_charges', 'service_tax_unit', 'two_wheeler_parking', 'facing', 'photo'], 'string', 'max' => 100],
            [['mobile_no', 'landline_no'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'available_for' => 'Available For',
            'property_id' => 'Property ID',
            'type' => 'Type',
            'location_id' => 'Location ID',
            'city_id' => 'City ID',
            'sublocation' => 'Sublocation',
            'landmark' => 'Landmark',
            'building_name' => 'Building Name',
            'area' => 'Area',
            'splitted_area' => 'Splitted Area',
            'total_no_of_floors' => 'Total No Of Floors',
            'floor_no' => 'Floor No',
            'office_no' => 'Office No',
            'rent_details' => 'Rent Details',
            'rentunit' => 'Rentunit',
            'deposite_details' => 'Deposite Details',
            'depositunit' => 'Depositunit',
            'rate_details' => 'Rate Details',
            'rate_details_unit' => 'Rate Details Unit',
            'maintenance_tax' => 'Maintenance Tax',
            'maintenance_tax_unit' => 'Maintenance Tax Unit',
            'service_tax_applicable' => 'Service Tax Applicable',
            'service_tax_value' => 'Service Tax Value',
            'other_charges' => 'Other Charges',
            'other_charges_unit' => 'Other Charges Unit',
            'service_tax_unit' => 'Service Tax Unit',
            'description' => 'Description',
            'furnished' => 'Furnished',
            'reception' => 'Reception',
            'min_workstations' => 'Min Workstations',
            'max_workstations' => 'Max Workstations',
            'cubicle' => 'Cubicle',
            'cabin' => 'Cabin',
            'half_cabin' => 'Half Cabin',
            'boardroom' => 'Boardroom',
            'conference_room' => 'Conference Room',
            'meeting_room' => 'Meeting Room',
            'discussion_room' => 'Discussion Room',
            'admin_room' => 'Admin Room',
            'account_room' => 'Account Room',
            'interview_room' => 'Interview Room',
            'storage_room' => 'Storage Room',
            'ups_room' => 'Ups Room',
            'server_room' => 'Server Room',
            'hub_room' => 'Hub Room',
            'epabx_room' => 'Epabx Room',
            'ahu_room' => 'Ahu Room',
            'electrical_room' => 'Electrical Room',
            'store_room' => 'Store Room',
            'pantry' => 'Pantry',
            'cafeteria' => 'Cafeteria',
            'toilets' => 'Toilets',
            'power_backup' => 'Power Backup',
            'lift_facility' => 'Lift Facility',
            'four_wheeler_parking' => 'Four Wheeler Parking',
            'two_wheeler_parking' => 'Two Wheeler Parking',
            'outer_power_backup' => 'Outer Power Backup',
            'frontedge' => 'Frontedge',
            'frontedge_height' => 'Frontedge Height',
            'mezzanine' => 'Mezzanine',
            'mezzanine_height' => 'Mezzanine Height',
            'warehouse_height' => 'Warehouse Height',
            'power_load' => 'Power Load',
            'open_area' => 'Open Area',
            'office_shed_area' => 'Office Shed Area',
            'owners_name' => 'Owners Name',
            'mobile_no' => 'Mobile No',
            'landline_no' => 'Landline No',
            'email_id' => 'Email ID',
            'other_details' => 'Other Details',
            'website_link' => 'Website Link',
            'proposal_title' => 'Proposal Title',
            'commercial_offer' => 'Commercial Offer',
            'note' => 'Note',
            'lenden_address' => 'Lenden Address',
            'picasa_url' => 'Picasa Url',
            'facing' => 'Facing',
            'ideal_for' => 'Ideal For',
            'available_from' => 'Available From',
            'gallery_images' => 'Gallery Images',
            'water_availability' => 'Water Availability',
            'photo' => 'Photo',
            'publish_on_web' => 'Publish On Web',
            'added_on' => 'Added On',
            'added_by' => 'Added By',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
            'reason' => 'Reason',
            'status' => 'Status',
            'rate_details_comp' => 'Rate Details Comp',
            'rent_details_comp' => 'Rent Details Comp',
            'deposite_details_comp' => 'Deposite Details Comp',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblEnquirylogs()
    {
        return $this->hasMany(TblEnquirylog::className(), ['property_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblPropertyfiles()
    {
        return $this->hasMany(TblPropertyfiles::className(), ['property_id' => 'id']);
    }

    public function getLocations()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }
}
