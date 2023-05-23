<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Location $model */

$this->title = 'Update Location: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'locationId' => $model->locationId]];
$this->params['breadcrumbs'][] = 'Update';
$this->registerJsFile( 'js/inputAutocompleter.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>
<div class="location-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&libraries=places&v=weekly"
        defer
></script>
