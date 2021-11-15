<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use kartik\widgets\ActiveForm;

$this->title = 'Update Data Nomor Handphone';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anggota-update-hp">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Silahkan update data nomor handphone aktif dengan teliti.</p>

    <div class="anggota-form">

    <?php $form = ActiveForm::begin([
    //'id' => 'form-signup',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],
    'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'nomor_hp',['addon' => ['prepend' => ['content' => '+62']]])->textInput(['maxlength' => true,'placeholder' => '81212345678 (tanpa dimulai angka 0)','disabled'=>($model->scenario == 'update')? TRUE : FALSE])->hint('contoh: 81212345678 (tanpa dimulai angka 0)') ?>

    <?= $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::classname(), ['options' => ['class' => 'form-control']])->hint('Klik pada gambar captcha jika tidak terbaca') ?>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary btn-lg']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    </div>
</div>
