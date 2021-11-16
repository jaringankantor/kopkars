<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Form */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-form">

    <?php $form = ActiveForm::begin([
        'encodeErrorSummary' => false,
        'errorSummaryCssClass' => 'help-block',
    ]); ?>

    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sheet_name')->textInput(['maxlength' => true]) ?> 

    <?= $form->field($model, 'baris_header')->textInput() ?>

    <?= $form->field($model, 'baris_isi')->textInput() ?>

    <?= $form->field($model, 'deskripsi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_excel')->widget(FileInput::classname()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
