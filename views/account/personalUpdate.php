<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Sector;

/** @var yii\web\View $this */
/** @var app\models\Account $model */

$this->title = 'Mise à jour du compte: ' . Yii::$app->user->identity->email;
$this->params['breadcrumbs'][] = 'Mise à jour';
?>
<div class="account-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="account-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'firstname')->textInput(['maxlength' => true])->label('Prénom') ?>

        <?= $form->field($model, 'lastname')->textInput(['maxlength' => true])->label('Nom de famille') ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label('E-mail') ?>

        <?= $form->field($model, 'phone')->textInput(['maxlength' => true])->label('Numéro de téléphone') ?>

        <?= $form->field($model, 'sectorId')->dropDownList(ArrayHelper::map(Sector::find()->all(), 'sectorId', 'name'))->label('Fillière') ?>


        <div class="form-group">
            <?= Html::submitButton('Enregistrer', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
