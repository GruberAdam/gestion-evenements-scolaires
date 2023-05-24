<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use app\models\Apprentice;
$this->title = 'Calendrier';

Yii::$app->assetManager->bundles['yii\web\JqueryAsset'] = [
    'sourcePath' => null,
    'js' => ['jquery.js' => 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.js'],
];
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>

<?php // Multiple select without model
// Normal select with ActiveForm & model
echo $form->field($model, 'displayCalendarAccount')->widget(Select2::class, [
    'data' => yii\helpers\ArrayHelper::map(Apprentice::find()->all(), 'id', 'email'),
    'language' => 'fr',
    'options' => ['placeholder' => 'Séléctionner les apprentis', 'multiple' => false, 'value' => yii\helpers\ArrayHelper::map(\app\models\Registration::find()->where(['timeSlotId' => $model->timeSlotId])->all(),'eventAccountId', 'apprenticeId')],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);
?>

<?= Html::submitButton('Chercher', ['class' => 'btn btn-primary', 'name' => 'confirm-button']) ?>

<?= Html::a('Genérer ICS', ['generate-ics', 'id' => $apprentice], ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>
<br>
<?= \yii2fullcalendar\yii2fullcalendar::widget(array(
    'events'=> $events,
    'themeSystem' => "",
    'contentHeight' => 550,
    'options' => [
        'lang' => 'fr',
    ]

));
?>