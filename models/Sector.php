<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sector".
 *
 * @property int $sectorId
 * @property string $name
 *
 * @property Account[] $accounts
 * @property Apprentice[] $apprentices
 */
class Sector extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sector';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sectorId' => 'Sector ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Accounts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts()
    {
        return $this->hasMany(Account::class, ['sectorId' => 'sectorId']);
    }

    /**
     * Gets query for [[Apprentices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApprentices()
    {
        return $this->hasMany(Apprentice::class, ['sectorId' => 'sectorId']);
    }
}
