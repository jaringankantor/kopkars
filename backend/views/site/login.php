<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::classname(), ['options' => ['class' => 'form-control']])->hint('Klik pada gambar captcha jika tidak terbaca') ?>

                <?php //echo $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
</div>