<?php

use yii\helpers\Html;
$this->title = 'Calendrier';

Yii::$app->assetManager->bundles['yii\web\JqueryAsset'] = [
    'sourcePath' => null,
    'js' => ['jquery.js' => 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.js'],
];
?>

<h1><?= Html::encode($this->title) ?></h1>


<?= \yii2fullcalendar\yii2fullcalendar::widget(array(
    'events'=> $events,
    'themeSystem' => "",
    'contentHeight' => 700,
    'options' => [
        'lang' => 'fr',
    ]

));
?>