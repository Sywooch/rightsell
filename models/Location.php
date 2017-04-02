<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_location".
 *
 * @property integer $id
 * @property string $location
 * @property integer $city_id
 * @property integer $group_id
 * @property string $added_on
 * @property integer $added_by
 * @property string $updated_on
 * @property integer $updated_by
 * @property integer $is_in_use
 * @property integer $count
 * @property integer $status
 *
 * @property TblCommercialproject[] $tblCommercialprojects
 * @property TblLocationgroup $group
 * @property Users $addedBy
 * @property Users $updatedBy
 * @property TblResidentialprojectBack[] $tblResidentialprojectBacks
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['location', 'added_on', 'added_by'], 'required'],
            [['location'], 'string'],
            [['city_id', 'group_id', 'added_by', 'updated_by', 'is_in_use', 'count', 'status'], 'integer'],
            [['added_on', 'updated_on'], 'safe'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblLocationgroup::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['added_by'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['added_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'location' => 'Location',
            'city_id' => 'City ID',
            'group_id' => 'Group ID',
            'added_on' => 'Added On',
            'added_by' => 'Added By',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
            'is_in_use' => 'Is In Use',
            'count' => 'Count',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblCommercialprojects()
    {
        return $this->hasMany(TblCommercialproject::className(), ['location_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(TblLocationgroup::className(), ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddedBy()
    {
        return $this->hasOne(Users::className(), ['id' => 'added_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(Users::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblResidentialprojectBacks()
    {
        return $this->hasMany(TblResidentialprojectBack::className(), ['project_location' => 'id']);
    }
}
