<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Account $model */

$this->title = Yii::$app->user->identity->email;

$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
Yii::$app->formatter->booleanFormat = ['Non', 'Oui'];
?>
<div class="account-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'personal' => 1], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'firstname',
            'lastname',
            'email:email',
            'phone',
            'sector.name',
        ],
    ]) ?>

    <?= Html::a('Changer de mot de passe', ['reset-password'], [
        'class' => 'btn btn-danger',
    ]) ?>

</div>
