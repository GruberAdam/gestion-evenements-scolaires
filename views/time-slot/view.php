<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\TimeSlot $model */

$this->title = $model->timeSlotId;
$this->params['breadcrumbs'][] = ['label' => 'Time Slots', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$this->registerJsFile( 'js/map.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg"></script>
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
        <?= Html::a('Ajouter des participants', ['time-slot/add-apprentice', 'id' => $model->timeSlotId], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'timeSlotId',
            [
                'attribute' => "Nom d'évènement",
                'value' => function ($data)
                {
                    return $data->event->title;
                }],
            [
                'attribute' => "Lieu",
                'value' => function ($data)
                {
                    return $data->event->location->title;
                }],
            [
                'attribute' => "Adresse",
                'value' => function ($data)
                {
                    return $data->event->location->address;
                }],
            [
                'attribute' => "date",
                'value' => function ($data)
                {
                    return str_replace("00:00:00", "", $data->date);
                }],
            [
                'attribute' => "Horaire",
                'value' => function ($data)
                {
                    return str_replace(":00", "", "$data->startTime"). "h à " . str_replace(":00", "", "$data->endTime"). "h";
                }],
            [
                'attribute' => "Nombre de participants",
                'value' => function ($data)
                {
                    return \app\models\Registration::find()->where(['timeSlotId' => $data->timeSlotId])->count();
                }],
        ],

    ]) ?>
    <h5 id="address"><?= $model->event->location->address?></h5>
    <div id="map" style="width:100%;height:350px;"></div>

</div>
