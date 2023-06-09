<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Sector $model */

$this->title = 'Update Sector: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sectors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'sectorId' => $model->sectorId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sector-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
