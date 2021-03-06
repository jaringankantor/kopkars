<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PesananPinjamanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pesanan-pinjaman-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kode_toko') ?>

    <?= $form->field($model, 'anggota_id') ?>

    <?= $form->field($model, 'nomor_referensi') ?>

    <?= $form->field($model, 'saldo_pokok') ?>

    <?php // echo $form->field($model, 'saldo_jasa') ?>

    <?php // echo $form->field($model, 'total_pembayaran') ?>

    <?php // echo $form->field($model, 'mulai_tanggal_pembayaran') ?>

    <?php // echo $form->field($model, 'rencana_tanggal_pelunasan') ?>

    <?php // echo $form->field($model, 'aktual_tanggal_pelunasan') ?>

    <?php // echo $form->field($model, 'peruntukan') ?>

    <?php // echo $form->field($model, 'lampiran') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <?php // echo $form->field($model, 'waktu') ?>

    <?php // echo $form->field($model, 'last_update_by') ?>

    <?php // echo $form->field($model, 'is_approved_level1')->checkbox() ?>

    <?php // echo $form->field($model, 'is_approved_level2')->checkbox() ?>

    <?php // echo $form->field($model, 'is_processed')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
