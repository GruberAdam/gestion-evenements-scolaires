<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "time_slot".
 *
 * @property int $timeSlotId
 * @property string $date
 * @property string $startTime
 * @property string $endTime
 * @property int $eventId
 *
 * @property Event $event
 * @property Registration[] $registrations
 */
class TimeSlot extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'time_slot';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'startTime', 'endTime', 'eventId'], 'required'],
            [['date', 'startTime', 'endTime'], 'safe'],
            [['eventId'], 'integer'],
            [['eventId'], 'exist', 'skipOnError' => true, 'targetClass' => Event::class, 'targetAttribute' => ['eventId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'timeSlotId' => 'Time Slot ID',
            'date' => 'Date',
            'startTime' => 'Start Time',
            'endTime' => 'End Time',
            'eventId' => 'Event ID',
        ];
    }

    /**
     * Gets query for [[Event]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::class, ['id' => 'eventId']);
    }

    /**
     * Gets query for [[Registrations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegistrations()
    {
        return $this->hasMany(Registration::class, ['timeSlotId' => 'timeSlotId']);
    }
}
