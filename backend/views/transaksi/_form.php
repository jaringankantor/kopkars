<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Transaksi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaksi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kanal_transaksi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nomor_referensi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nomor_pesanan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anggota_id')->textInput() ?>

    <?= $form->field($model, 'anggota_nomor_zahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_pelanggan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mata_uang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subtotal')->textInput() ?>

    <?= $form->field($model, 'diskon')->textInput() ?>

    <?= $form->field($model, 'pajak')->textInput() ?>

    <?= $form->field($model, 'total_penjualan')->textInput() ?>

    <?= $form->field($model, 'pembayaran')->textInput() ?>

    <?= $form->field($model, 'saldo')->textInput() ?>

    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'waktu')->textInput() ?>

    <?= $form->field($model, 'last_waktu_update')->textInput() ?>

    <?= $form->field($model, 'insert_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_update_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_deleted')->checkbox() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <?= $form->field($model, 'last_softdelete_by')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
