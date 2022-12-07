<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Place */

myzero1\adminlteiframe\gii\GiiAsset::register($this);

?>
<div class="place-view">
    <?= DetailView::widget([
        'model' => $model,
    ]) ?>

</div>