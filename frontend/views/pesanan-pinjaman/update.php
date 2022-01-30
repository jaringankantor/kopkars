<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PesananPinjaman */

$this->title = 'Update Pesanan Pinjaman: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pesanan Pinjamen', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pesanan-pinjaman-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
