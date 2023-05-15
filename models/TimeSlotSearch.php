<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TimeSlot;

/**
 * TimeSlotSearch represents the model behind the search form of `app\models\TimeSlot`.
 */
class TimeSlotSearch extends TimeSlot
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['timeSlotId', 'eventId'], 'integer'],
            [['date', 'startTime', 'endTime'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TimeSlot::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'timeSlotId' => $this->timeSlotId,
            'date' => $this->date,
            'startTime' => $this->startTime,
            'endTime' => $this->endTime,
            'eventId' => $this->eventId,
        ]);

        return $dataProvider;
    }
}
