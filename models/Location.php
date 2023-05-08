<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property int $locationId
 * @property string $title
 * @property string $address
 *
 * @property Event[] $events
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'address'], 'required'],
            [['title', 'address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'locationId' => 'Location ID',
            'title' => 'Title',
            'address' => 'Address',
        ];
    }

    /**
     * Gets query for [[Events]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::class, ['locationId' => 'locationId']);
    }
}
