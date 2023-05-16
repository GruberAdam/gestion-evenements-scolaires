<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\TimeSlot $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="time-slot-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'eventId')->dropDownList(ArrayHelper::map(\app\models\Event::find()->all(), 'id', 'title'))->label("Evènement") ?>


    <?= $form->field($model, 'date')->widget(\yii\jui\DatePicker::class, ['options' => ['class' => 'form-control'], 'dateFormat' => 'yyyy-MM-dd'])->label("Date de l'évènement")->textInput(['readonly' => true]) ?>


    <?php echo $form->field($model, 'startTime')->widget(janisto\timepicker\TimePicker::class, ['mode' => 'time', 'clientOptions' => ['timeFormat' => 'HH:mm', 'showSecond' => false]])->textInput(['readonly' => true])->label("Début de l'évènement")?>

    <?php echo $form->field($model, 'endTime')->widget(janisto\timepicker\TimePicker::class, ['mode' => 'time', 'clientOptions' => ['timeFormat' => 'HH:mm', 'showSecond' => false, 'onClose' => new \yii\web\JsExpression('function(dateText, inst) { console.log("onSelect: " + dateText); }'),]])->textInput(['readonly' => true])->label("Fin de l'évènement")?>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
