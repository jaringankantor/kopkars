<?php

use common\models\Form;
use common\models\Field;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\FormField */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-field-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_form')->dropDownList(ArrayHelper::map(Form::find()->all(),'kode','kode'),['prompt'=>'--Pilih--']) ?>

    <?= $form->field($model, 'nama_field_excel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kode_field')->dropDownList(ArrayHelper::map(Field::find()->all(),'kode','kode'),['prompt'=>'--Pilih--']) ?>

    <?= $form->field($model, 'deskripsi')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
