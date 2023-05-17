<?php

use yii\helpers\Html;
use Yii\web\Request;
/** @var yii\web\View $this */
/** @var app\models\Event $model */

$this->title = 'Crée un évènement';
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$this->registerJsFile( 'js/inputAutocompleter.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>

<div class="event-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&libraries=places&v=weekly"
        defer
></script>