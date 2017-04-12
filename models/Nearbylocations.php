<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nearbylocations".
 *
 * @property integer $id
 * @property integer $location_id
 * @property integer $nearbylocation_id
 *
 * @property TblLocation $location
 * @property TblLocation $nearbylocation
 */
class Nearbylocations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nearbylocations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['location_id', 'nearbylocation_id'], 'integer'],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblLocation::className(), 'targetAttribute' => ['location_id' => 'id']],
            [['nearbylocation_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblLocation::className(), 'targetAttribute' => ['nearbylocation_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'location_id' => 'Location ID',
            'nearbylocation_id' => 'Nearbylocation ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(TblLocation::className(), ['id' => 'location_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNearbylocation()
    {
        return $this->hasOne(TblLocation::className(), ['id' => 'nearbylocation_id']);
    }
}
