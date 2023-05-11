<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property int $id
 * @property string $title
 * @property int $locationId
 * @property int $locationInput
 * @property int $accountId
 *
 * @property Account $account
 * @property Location $location
 * @property TimeSlot[] $timeSlots
 */
class Event extends \yii\db\ActiveRecord
{
    public $locationInput;
    public $titleLocationInput;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'locationId', 'accountId', 'locationInput', 'titleLocationInput'], 'required'],
            [['locationId', 'accountId'], 'integer'],
            [['title', 'locationInput', 'titleLocationInput'], 'string', 'max' => 255],
            [['accountId'], 'exist', 'skipOnError' => true, 'targetClass' => Account::class, 'targetAttribute' => ['accountId' => 'id']],
            [['locationId'], 'exist', 'skipOnError' => true, 'targetClass' => Location::class, 'targetAttribute' => ['locationId' => 'locationId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'locationId' => 'Location ID',
            'locationInput' => 'input',
            'accountId' => 'Account ID',
        ];
    }

    /**
     * Gets query for [[Account]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::class, ['id' => 'accountId']);
    }

    /**
     * Gets query for [[Location]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::class, ['locationId' => 'locationId']);
    }

    /**
     * Gets query for [[TimeSlots]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTimeSlots()
    {
        return $this->hasMany(TimeSlot::class, ['eventId' => 'id']);
    }
}
