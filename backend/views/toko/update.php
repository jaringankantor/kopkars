<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Toko */

$this->title = 'Update Toko: ' . $model->kode;
$this->params['breadcrumbs'][] = ['label' => 'Tokos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode, 'url' => ['view', 'id' => $model->kode]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="toko-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
