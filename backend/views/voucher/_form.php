<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Voucher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="voucher-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_voucher')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_voucher')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kode_toko')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anggota_id')->textInput() ?>

    <?= $form->field($model, 'rupiah')->textInput() ?>

    <?= $form->field($model, 'rupiah_terpakai')->textInput() ?>

    <?= $form->field($model, 'berlaku_mulai')->textInput() ?>

    <?= $form->field($model, 'berakhir_sampai')->textInput() ?>

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
