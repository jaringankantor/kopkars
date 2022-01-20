<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Pinjaman */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pinjaman-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_toko')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anggota_id')->textInput() ?>

    <?= $form->field($model, 'saldo_pokok')->textInput() ?>

    <?= $form->field($model, 'saldo_jasa')->textInput() ?>

    <?= $form->field($model, 'total_pembayaran')->textInput() ?>

    <?= $form->field($model, 'mulai_tanggal_pembayaran')->textInput() ?>

    <?= $form->field($model, 'rencana_tanggal_pelunasan')->textInput() ?>

    <?= $form->field($model, 'aktual_tanggal_pelunasan')->textInput() ?>

    <?= $form->field($model, 'peruntukan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'waktu')->textInput() ?>

    <?= $form->field($model, 'last_waktu_update')->textInput() ?>

    <?= $form->field($model, 'insert_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_update_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_deleted')->checkbox() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <?= $form->field($model, 'last_softdelete_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nomor_referensi')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
