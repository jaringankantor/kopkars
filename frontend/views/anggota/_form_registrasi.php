<?php

use common\models\Anggota;
//use yii\widgets\ActiveForm;
//use yii\bootstrap\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use kartik\widgets\Select2; // or kartik\select2\Select2
use yii\helpers\Html;
use yii\web\JsExpression;


/* @var $this yii\web\View */
/* @var $model common\models\Anggota */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anggota-form">

    <?php $form = ActiveForm::begin([
    //'id' => 'form-signup',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],
    'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'foto')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
    ]); ?>

    <?= $form->field($model, 'email',['addon' => ['prepend' => ['content'=>'@']]])->textInput(['maxlength' => true])->textInput(['maxlength' => true,'placeholder' => 'Email pribadi aktif (diutamakan email PNJ)','disabled'=>($model->scenario == 'update')? TRUE : FALSE]) ?>

    <?= $form->field($model, 'password_default',['addon' => ['prepend' => ['content'=>'*']]])->passwordInput(['maxlength' => true,'placeholder' => 'Password untuk login ke aplikasi KOPKARS PNJ','disabled'=>($model->scenario == 'update')? TRUE : FALSE]) ?>

    <?= $form->field($model, 're_password',['addon' => ['prepend' => ['content'=>'*']]])->passwordInput(['maxlength' => true,'placeholder' => 'Ulangi password diatas','disabled'=>($model->scenario == 'update')? TRUE : FALSE]) ?>

    <?= $form->field($model, 'nomor_hp',['addon' => ['prepend' => ['content' => '+62']]])->textInput(['maxlength' => true,'placeholder' => '81212345678 (tanpa dimulai angka 0)','disabled'=>($model->scenario == 'update')? TRUE : FALSE]) ?>

    <?php //$form->field($model, 'nomor_pegawai')->textInput(['maxlength' => true]) ?>

    <?php
    $url = \yii\helpers\Url::to(['anggota/select-karyawan-pnj']);

    $karyawan_pnj = empty($model->nomor_pegawai) ? '' : $model->nomor_pegawai;

    echo $form->field($model, 'nomor_pegawai')->widget(Select2::classname(), [
        'initValueText' => $karyawan_pnj, // set the initial display text
        'options' => ['placeholder' => 'Masukan sebagian nama....'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 5,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' => $url,
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(anggota) { return anggota.text; }'),
            'templateSelection' => new JsExpression('function (anggota) { return anggota.text; }'),
        ],
    ]);
    ?>

    <?= $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::classname(), ['options' => ['class' => 'form-control']])->hint('Klik pada gambar captcha jika tidak terbaca') ?>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary btn-lg']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
