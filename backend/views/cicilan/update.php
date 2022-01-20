<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Cicilan */

$this->title = 'Update Cicilan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cicilans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cicilan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
