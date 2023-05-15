<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TimeSlotSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="time-slot-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'timeSlotId') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'startTime') ?>

    <?= $form->field($model, 'endTime') ?>

    <?= $form->field($model, 'eventId') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
