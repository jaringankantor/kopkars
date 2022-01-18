<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Voucher */

$this->title = 'Update Voucher: ' . $model->kode_voucher;
$this->params['breadcrumbs'][] = ['label' => 'Vouchers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_voucher, 'url' => ['view', 'kode_voucher' => $model->kode_voucher, 'kode_toko' => $model->kode_toko]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="voucher-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
