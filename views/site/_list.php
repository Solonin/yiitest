<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

<div class="news-item">
    <h3><?= Html::encode($model->title) ?></h3>
    <?= HtmlPurifier::process($model->author->name) ?><br>
    <?= HtmlPurifier::process($model->year) ?>
</div>

