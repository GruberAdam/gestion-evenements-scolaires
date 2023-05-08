<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property int $sectorId
 * @property string $authKey
 * @property bool $isAdmin
 * @property string $password
 *
 * @property Event[] $events
 * @property Sector $sector
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'email', 'sectorId', 'authKey', 'isAdmin', 'password'], 'required'],
            [['sectorId', 'isAdmin'], 'integer'],
            [['firstname', 'lastname', 'authKey', 'password'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['authKey'], 'unique'],
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
            'authKey' => 'Auth Key',
            'isAdmin' => 'Is Admin',
            'password' => 'Password',
        ];
    }

    /**
     * Gets query for [[Events]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::class, ['accountId' => 'id']);
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
