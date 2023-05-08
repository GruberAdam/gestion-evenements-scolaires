<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Sector $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sectors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sector-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'sectorId' => $model->sectorId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'sectorId' => $model->sectorId], [
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
            'sectorId',
            'name',
        ],
    ]) ?>

</div>
