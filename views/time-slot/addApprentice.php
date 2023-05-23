<?php

use app\models\Apprentice;
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

$this->title = 'Mes évènements';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="time-slot-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?php // Multiple select without model
    // Normal select with ActiveForm & model
    echo $form->field($model, 'apprenticeSelected')->widget(Select2::class, [
        'data' => yii\helpers\ArrayHelper::map(Apprentice::find()->all(), 'id', 'email'),
        'language' => 'fr',
        'options' => ['placeholder' => 'Séléctionner les apprentis', 'multiple' => true, 'value' => yii\helpers\ArrayHelper::map(\app\models\Registration::find()->where(['timeSlotId' => $model->timeSlotId])->all(),'eventAccountId', 'apprenticeId')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
?>

    <?= Html::submitButton('Confirmer', ['class' => 'btn btn-primary', 'name' => 'confirm-button']) ?>

    <?php ActiveForm::end(); ?>

</div>
