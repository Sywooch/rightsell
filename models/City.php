<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_city".
 *
 * @property integer $id
 * @property string $city
 * @property string $added_on
 * @property integer $added_by
 * @property string $updated_on
 * @property integer $updated_by
 * @property integer $is_in_use
 * @property integer $count
 * @property integer $status
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city', 'added_on', 'added_by'], 'required'],
            [['city'], 'string'],
            [['added_on', 'updated_on'], 'safe'],
            [['added_by', 'updated_by', 'is_in_use', 'count', 'status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city' => 'City',
            'added_on' => 'Added On',
            'added_by' => 'Added By',
            'updated_on' => 'Updated On',
            'updated_by' => 'Updated By',
            'is_in_use' => 'Is In Use',
            'count' => 'Count',
            'status' => 'Status',
        ];
    }
}
