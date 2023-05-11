<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        L'erreur est apparue pendant votre requete.
    </p>
    <p>
        S'il vous plaît contactez nous si vous pensez que c'est une erreur du serveur. Merci.
    </p>

</div>
