<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use kartik\widgets\ActiveForm;

$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Silahkan isi email, password, dan kode captcha yang muncul pada gambar.</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'enableAjaxValidation'   => false,
                'enableClientValidation' => true,
                'type' => ActiveForm::TYPE_HORIZONTAL,
                'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
            ]); ?>

                <?= $form->field($model, 'email',['addon' => ['prepend' => ['content'=>'@']]])->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password',['addon' => ['prepend' => ['content'=>'*']]])->passwordInput() ?>

                <?= $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::classname(), ['options' => ['class' => 'form-control']])->hint('Klik pada gambar captcha jika tidak terbaca') ?>

                <?php //echo $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-lg', 'name' => 'login-button']) ?>
                    </div>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <p>Lupa password? <?= Html::a('klik untuk reset', ['site/request-password-reset']) ?>. Belum verifikasi email? <?= Html::a('klik untuk verifikasi', ['site/resend-verification-email']) ?></p>
</div>
