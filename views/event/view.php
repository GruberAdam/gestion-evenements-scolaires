<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Event $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->registerJsFile( 'js/map.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg"></script>


<div class="event-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                    'attribute' => "Titre De l'évènement",
                'value' => function ($data)
                {
                    return $data->title;
                }],
            [
                'attribute' => "Lieu",
                'value' => function ($data)
                {
                    return $data->location->title;
                }],
            [
                'attribute' => "Adresse",
                'value' => function ($data)
                {
                    return $data->location->address;
                }],
            [
                'attribute' => "Responsable",
                'value' => function ($data)
                {
                    return $data->account->email;
                }],
            [
                'attribute' => "Téléphone du responsable",
                'value' => function ($data)
                {
                    return $data->account->phone;
                }],
        ],
    ]) ?>
    <br><br>
    <h5 id="address"><?= $model->location->address?></h5>
    <div id="map" style="width:100%;height:300px;"></div>
    <script>

    </script>
</div>




