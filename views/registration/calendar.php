<?php

use yii\helpers\Html;
$this->title = 'Calendrier';
?>

<h1><?= Html::encode($this->title) ?></h1>


<?= \yii2fullcalendar\yii2fullcalendar::widget(array(
    'events'=> $events,
    'themeSystem' => "",


));
?>