<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $category
 * @property string $working_sector
 * @property string $password
 * @property string $email
 * @property integer $status
 *
 * @property Profiles[] $profiles
 * @property Profiles[] $profiles0
 * @property Profiles $profiles1
 * @property TblCommercialproject[] $tblCommercialprojects
 * @property TblCommercialproject[] $tblCommercialprojects0
 * @property TblContacts[] $tblContacts
 * @property TblContacts[] $tblContacts0
 * @property TblHotcases[] $tblHotcases
 * @property TblHotcases[] $tblHotcases0
 * @property TblHotcasesBeforeMigration[] $tblHotcasesBeforeMigrations
 * @property TblHotcasesBeforeMigration[] $tblHotcasesBeforeMigrations0
 * @property TblLocation[] $tblLocations
 * @property TblLocation[] $tblLocations0
 * @property TblLocationgroup[] $tblLocationgroups
 * @property TblLocationgroup[] $tblLocationgroups0
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category', 'email'], 'required'],
            [['working_sector'], 'string'],
            [['status'], 'integer'],
            [['category'], 'string', 'max' => 11],
            [['password'], 'string', 'max' => 128],
            [['email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Category',
            'working_sector' => 'Working Sector',
            'password' => 'Password',
            'email' => 'Email',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profiles::className(), ['added_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles0()
    {
        return $this->hasMany(Profiles::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles1()
    {
        return $this->hasOne(Profiles::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblCommercialprojects()
    {
        return $this->hasMany(TblCommercialproject::className(), ['added_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblCommercialprojects0()
    {
        return $this->hasMany(TblCommercialproject::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblContacts()
    {
        return $this->hasMany(TblContacts::className(), ['added_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblContacts0()
    {
        return $this->hasMany(TblContacts::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblHotcases()
    {
        return $this->hasMany(TblHotcases::className(), ['added_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblHotcases0()
    {
        return $this->hasMany(TblHotcases::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblHotcasesBeforeMigrations()
    {
        return $this->hasMany(TblHotcasesBeforeMigration::className(), ['added_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblHotcasesBeforeMigrations0()
    {
        return $this->hasMany(TblHotcasesBeforeMigration::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblLocations()
    {
        return $this->hasMany(TblLocation::className(), ['added_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblLocations0()
    {
        return $this->hasMany(TblLocation::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblLocationgroups()
    {
        return $this->hasMany(TblLocationgroup::className(), ['added_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblLocationgroups0()
    {
        return $this->hasMany(TblLocationgroup::className(), ['updated_by' => 'id']);
    }
}
