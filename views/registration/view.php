<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Registration $model */

$this->title = $model->eventAccountId;
$this->params['breadcrumbs'][] = ['label' => 'Registrations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="registration-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'eventAccountId' => $model->eventAccountId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'eventAccountId' => $model->eventAccountId], [
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
            'eventAccountId',
            'apprenticeId',
            'timeSlotId:datetime',
        ],
    ]) ?>

</div>
