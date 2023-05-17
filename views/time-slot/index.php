<?php

use app\models\TimeSlot;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TimeSlotSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Time Slots';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="time-slot-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Time Slot', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'timeSlotId',
            'date',
            'startTime',
            'endTime',
            'eventId',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TimeSlot $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'timeSlotId' => $model->timeSlotId]);
                 }
            ],
        ],
    ]); ?>


</div>
