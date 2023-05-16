<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Registration $model */

$this->title = 'Update Registration: ' . $model->eventAccountId;
$this->params['breadcrumbs'][] = ['label' => 'Registrations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->eventAccountId, 'url' => ['view', 'eventAccountId' => $model->eventAccountId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="registration-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
