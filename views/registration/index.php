<?php

use app\models\Registration;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\RegistrationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Registrations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registration-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Registration', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'eventAccountId',
            'apprenticeId',
            'timeSlotId:datetime',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Registration $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'eventAccountId' => $model->eventAccountId]);
                 }
            ],
        ],
    ]); ?>


</div>
