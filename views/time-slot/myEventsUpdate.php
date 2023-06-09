<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\TimeSlot $model */

$this->title = 'Update event';
$this->params['breadcrumbs'][] = 'Update';

$this->registerJsFile( 'js/inputAutocompleter.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>
    <h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'eventId')->dropDownList(ArrayHelper::map(\app\models\Event::find()->where(['accountId' => Yii::$app->user->id])->all(), 'id', 'title'))->label("Evènement") ?>

<?= $form->field($model, 'date')->widget(\yii\jui\DatePicker::class, ['options' => ['class' => 'form-control'], 'dateFormat' => 'yyyy-MM-dd'])->label("Date de l'évènement")->textInput(['readonly' => true]) ?>

<?= $form->field($model, 'titleLocationInput')->dropDownList(ArrayHelper::map(\app\models\Location::find()->all(), 'locationId', 'title'),  ['options' => [$model->event->locationId => ['Selected' => true]]])->label("Titre du lieu") ?>

<?php echo $form->field($model, 'startTime')->widget(janisto\timepicker\TimePicker::class, ['mode' => 'time', 'clientOptions' => ['timeFormat' => 'HH:mm', 'showSecond' => false]])->textInput(['readonly' => true, 'value' => str_replace(":00","",$model->startTime)])->label("Début de l'évènement")?>

<?php echo $form->field($model, 'endTime')->widget(janisto\timepicker\TimePicker::class, ['mode' => 'time', 'clientOptions' => ['timeFormat' => 'HH:mm', 'showSecond' => false,]])->textInput(['readonly' => true, 'value' => str_replace(":00","",$model->endTime)])->label("Fin de l'évènement")?>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&libraries=places&v=weekly"
        defer
></script>
