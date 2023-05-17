<?php

use app\models\TimeSlot;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TimeSlotSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Mes évènements';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="time-slot-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Time Slot', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'timeSlots' => $timeSlots,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'event.title',
            [
                'attribute' => 'Date',
                'value' => function ($data)
                {
                    return str_replace("00:00:00","",$data->date);
                }
            ],
            [
                'attribute' => 'Horaire',
                'value' => function ($data)
                {
                    return str_replace(":00","",$data->startTime) . " à " . str_replace(":00","",$data->endTime);
                }
            ],
            [
                'attribute' => 'Lieu',
                'value' => function ($data)
                {
                    return $data->event->location->title;
                }
            ],
            [
                'attribute' => 'Nb de participants',
                'value' => function ($data)
                {
                    return \app\models\Registration::find()->where(['timeSlotId' => $data->timeSlotId])->count();
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TimeSlot $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'timeSlotId' => $model->timeSlotId]);
                }
            ],
        ],
    ]); ?>


</div>
