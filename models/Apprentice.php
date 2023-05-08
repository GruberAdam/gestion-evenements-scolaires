<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "apprentice".
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property int $sectorId
 * @property string $class
 * @property string|null $phone
 *
 * @property Registration[] $registrations
 * @property Sector $sector
 */
class Apprentice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apprentice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'email', 'sectorId', 'class'], 'required'],
            [['sectorId'], 'integer'],
            [['firstname', 'lastname', 'email', 'class', 'phone'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['sectorId'], 'exist', 'skipOnError' => true, 'targetClass' => Sector::class, 'targetAttribute' => ['sectorId' => 'sectorId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'email' => 'Email',
            'sectorId' => 'Sector ID',
            'class' => 'Class',
            'phone' => 'Phone',
        ];
    }

    /**
     * Gets query for [[Registrations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegistrations()
    {
        return $this->hasMany(Registration::class, ['apprenticeId' => 'id']);
    }

    /**
     * Gets query for [[Sector]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSector()
    {
        return $this->hasOne(Sector::class, ['sectorId' => 'sectorId']);
    }
}
