<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_society".
 *
 * @property integer $id
 * @property string $society_name
 * @property integer $location
 * @property integer $added_by
 * @property string $added_on
 * @property string $updated_on
 * @property integer $updated_by
 * @property integer $is_in_use
 * @property integer $status
 */
class Society extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_society';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['society_name', 'location', 'added_by', 'added_on'], 'required'],
            [['location', 'added_by', 'updated_by', 'is_in_use', 'status'], 'integer'],
            [['added_on', 'updated_on'], 'safe'],
            [['society_name'], 'string', 'max' => 124],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'society_name' => 'Society Name',
            'location' => 'Location',
            'added_by' => 'Added By',
            'added_on' => 'Added On',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
            'is_in_use' => 'Is In Use',
            'status' => 'Status',
        ];
    }
}
