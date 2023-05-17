<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Account;

/** @var yii\web\View $this */
/** @var app\models\Event $model */
/** @var yii\widgets\ActiveForm $form */

?>
<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label("Titre de l'évènement") ?>

    <?= $form->field($model, 'titleLocationInput')->textInput(['maxlength' => true])->label("Titre du lieu") ?>

    <?= $form->field($model, 'locationInput', ['inputOptions' => ['id' => 'pac-input']])->textInput(['class' => 'form-control punjabi'])->label('Adresse') ?>
    <div id="map"></div>
    <div id="infowindow-content">
        <span id="place-name" class="title"></span><br />
        <span id="place-address"></span>
    </div>

    <?= $form->field($model, 'accountId')->dropDownList(ArrayHelper::map(Account::find()->all(), 'id', 'email'))->label("Responsable de l'évènement") ?>


    <div class="form-group">
        <?= Html::submitButton('Enregistrer', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>
