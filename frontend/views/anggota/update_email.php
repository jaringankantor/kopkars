<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use kartik\widgets\ActiveForm;

$this->title = 'Update Data Email';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anggota-update-email">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Silahkan update data email aktif dengan teliti, selanjutnya silahkan klik link verifikasi yang akan kami kirim ke email.</p>

    <div class="anggota-form">

    <?php $form = ActiveForm::begin([
    //'id' => 'form-signup',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],
    'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'email',['addon' => ['prepend' => ['content'=>'@']]])->textInput(['maxlength' => true])->textInput(['maxlength' => true,'placeholder' => 'Email pribadi aktif (diutamakan email PNJ)','disabled'=>($model->scenario == 'update')? TRUE : FALSE]) ?>

    <?= $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::classname(), ['options' => ['class' => 'form-control']])->hint('Klik pada gambar captcha jika tidak terbaca') ?>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary btn-lg']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    </div>
</div>
