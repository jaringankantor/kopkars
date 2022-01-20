<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Cicilan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cicilan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_toko')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anggota_id')->textInput() ?>

    <?= $form->field($model, 'kanal_cicilan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nomor_referensi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cicilan')->textInput() ?>

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
