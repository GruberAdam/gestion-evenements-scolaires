<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TimeSlot $model */

$this->title = 'Update Time Slot: ' . $model->timeSlotId;
$this->params['breadcrumbs'][] = ['label' => 'Time Slots', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->timeSlotId, 'url' => ['view', 'timeSlotId' => $model->timeSlotId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="time-slot-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
