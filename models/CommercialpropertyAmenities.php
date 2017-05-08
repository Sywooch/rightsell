<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_commercialproperty_amenities".
 *
 * @property integer $id
 * @property integer $property_id
 * @property integer $amenity_id
 */
class CommercialpropertyAmenities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_commercialproperty_amenities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['property_id', 'amenity_id'], 'required'],
            [['property_id', 'amenity_id'], 'integer'],
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
            'amenity_id' => 'Amenity ID',
        ];
    }
}
