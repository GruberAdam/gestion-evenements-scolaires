<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Location $model */
/** @var yii\widgets\ActiveForm $form */


?>

<div class="location-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address', ['inputOptions' => ['id' => 'pac-input']])->textInput(['class' => 'form-control punjabi'])->label('Adresse') ?>
    <div id="map"></div>
    <div id="infowindow-content">
        <span id="place-name" class="title"></span><br />
        <span id="place-address"></span>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>