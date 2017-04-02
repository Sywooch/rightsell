<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_bhk".
 *
 * @property integer $id
 * @property string $name
 * @property integer $added_by
 * @property string $added_on
 * @property integer $updated_by
 * @property string $updated_on
 * @property integer $is_in_use
 * @property integer $status
 */
class Bhk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bhk';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'added_by', 'added_on'], 'required'],
            [['added_by', 'updated_by', 'is_in_use', 'status'], 'integer'],
            [['added_on', 'updated_on'], 'safe'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'added_by' => 'Added By',
            'added_on' => 'Added On',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'is_in_use' => 'Is In Use',
            'status' => 'Status',
        ];
    }
}
