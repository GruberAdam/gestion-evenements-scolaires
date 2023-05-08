<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registration".
 *
 * @property int $eventAccountId
 * @property int $apprenticeId
 * @property int $timeSlotId
 *
 * @property Apprentice $apprentice
 * @property TimeSlot $timeSlot
 */
class Registration extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'registration';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['apprenticeId', 'timeSlotId'], 'required'],
            [['apprenticeId', 'timeSlotId'], 'integer'],
            [['apprenticeId'], 'exist', 'skipOnError' => true, 'targetClass' => Apprentice::class, 'targetAttribute' => ['apprenticeId' => 'id']],
            [['timeSlotId'], 'exist', 'skipOnError' => true, 'targetClass' => TimeSlot::class, 'targetAttribute' => ['timeSlotId' => 'timeSlotId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'eventAccountId' => 'Event Account ID',
            'apprenticeId' => 'Apprentice ID',
            'timeSlotId' => 'Time Slot ID',
        ];
    }

    /**
     * Gets query for [[Apprentice]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApprentice()
    {
        return $this->hasOne(Apprentice::class, ['id' => 'apprenticeId']);
    }

    /**
     * Gets query for [[TimeSlot]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTimeSlot()
    {
        return $this->hasOne(TimeSlot::class, ['timeSlotId' => 'timeSlotId']);
    }
}
