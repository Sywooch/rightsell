<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_area".
 *
 * @property integer $id
 * @property string $area
 * @property integer $city_id
 * @property string $added_on
 * @property integer $added_by
 * @property string $updated_on
 * @property integer $updated_by
 * @property integer $is_in_use
 * @property integer $count
 * @property integer $status
 */
class Area extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'area', 'added_on', 'added_by'], 'required'],
            [['id', 'city_id', 'added_by', 'updated_by', 'is_in_use', 'count', 'status'], 'integer'],
            [['area'], 'string'],
            [['added_on', 'updated_on'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'area' => 'Area',
            'city_id' => 'City ID',
            'added_on' => 'Added On',
            'added_by' => 'Added By',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
            'is_in_use' => 'Is In Use',
            'count' => 'Count',
            'status' => 'Status',
        ];
    }

    public function getArea()
    {
        return $this->hasOne(ResidentialProperty::className(), ['area_id' => 'id']);
    }
}
