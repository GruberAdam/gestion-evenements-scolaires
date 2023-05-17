<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\TimeSlot $model */

$this->title = $model->timeSlotId;
$this->params['breadcrumbs'][] = ['label' => 'Time Slots', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="time-slot-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'timeSlotId' => $model->timeSlotId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'timeSlotId' => $model->timeSlotId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'timeSlotId',
            'date',
            'startTime',
            'endTime',
            'eventId',
        ],
    ]) ?>

</div>
