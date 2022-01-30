<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PesananPinjaman */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pesanan-pinjaman-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_toko')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anggota_id')->textInput() ?>

    <?= $form->field($model, 'nomor_referensi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'saldo_pokok')->textInput() ?>

    <?= $form->field($model, 'saldo_jasa')->textInput() ?>

    <?= $form->field($model, 'total_pembayaran')->textInput() ?>

    <?= $form->field($model, 'mulai_tanggal_pembayaran')->textInput() ?>

    <?= $form->field($model, 'rencana_tanggal_pelunasan')->textInput() ?>

    <?= $form->field($model, 'aktual_tanggal_pelunasan')->textInput() ?>

    <?= $form->field($model, 'peruntukan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lampiran')->textInput() ?>

    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'waktu')->textInput() ?>

    <?= $form->field($model, 'last_update_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_approved_level1')->checkbox() ?>

    <?= $form->field($model, 'is_approved_level2')->checkbox() ?>

    <?= $form->field($model, 'is_processed')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
