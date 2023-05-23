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

    <?= $form->field($model, 'titleLocationInput')->dropDownList(ArrayHelper::map(\app\models\Location::find()->all(), 'locationId', 'title'),  ['options' => [$model->locationId => ['Selected' => true]]])->label("Titre du lieu") ?>

    <?= $form->field($model, 'accountId')->dropDownList(ArrayHelper::map(Account::find()->all(), 'id', 'email'),['options' => [Yii::$app->user->id => ['Selected' => true]]] )->label("Responsable de l'évènement") ?>


    <div class="form-group">
        <?= Html::submitButton('Enregistrer', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>
