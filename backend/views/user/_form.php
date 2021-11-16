<?php

use common\models\Toko;
//use yii\bootstrap\ActiveForm;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        //'id' => 'form-signup',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],
    ]); ?>

    <?= $form->field($model, 'kode_toko')->dropDownList(ArrayHelper::map(Toko::find()->all(),'kode','nama_toko'),['prompt'=>'--Pilih--']) ?>

    <?= $form->field($model, 'email',['addon' => ['prepend' => ['content'=>'@']]])->textInput(['maxlength' => true])->textInput(['maxlength' => true,'placeholder' => 'Email pribadi aktif','disabled'=>($model->scenario == 'update')? TRUE : FALSE]) ?>

    <?= $form->field($model, 'password_default',['addon' => ['prepend' => ['content'=>'*']]])->passwordInput(['maxlength' => true,'placeholder' => 'Password untuk login ke aplikasi APEI','disabled'=>($model->scenario == 'update')? TRUE : FALSE]) ?>
    
    <?= $form->field($model, 're_password',['addon' => ['prepend' => ['content'=>'*']]])->passwordInput(['maxlength' => true,'placeholder' => 'Ulangi password diatas','disabled'=>($model->scenario == 'update')? TRUE : FALSE]) ?>

    <?php

    $toko=Toko::findOne(['kode'=>Yii::$app->user->identity->kode_toko]);

    foreach ($toko->attributes as $key => $value) {
        if(substr($key,0,9)=='skuprefix'&&!empty($value)){
            $skuprefix[$value]=$value;
        }
    }
    
    echo $form->field($model, 'skuprefix1')->dropDownList($skuprefix,['prompt'=>'--Pilih--']);

    echo $form->field($model, 'skuprefix2')->dropDownList($skuprefix,['prompt'=>'--Pilih--']);

    echo $form->field($model, 'skuprefix3')->dropDownList($skuprefix,['prompt'=>'--Pilih--']);

    echo $form->field($model, 'skuprefix4')->dropDownList($skuprefix,['prompt'=>'--Pilih--']);

    echo $form->field($model, 'skuprefix5')->dropDownList($skuprefix,['prompt'=>'--Pilih--']);
    
    echo $form->field($model, 'skuprefix6')->dropDownList($skuprefix,['prompt'=>'--Pilih--']);
    
    echo $form->field($model, 'skuprefix7')->dropDownList($skuprefix,['prompt'=>'--Pilih--']);

    echo $form->field($model, 'skuprefix8')->dropDownList($skuprefix,['prompt'=>'--Pilih--']);

    echo $form->field($model, 'skuprefix9')->dropDownList($skuprefix,['prompt'=>'--Pilih--']);

    echo $form->field($model, 'skuprefix10')->dropDownList($skuprefix,['prompt'=>'--Pilih--']);

    ?>

    <?= $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::classname(), ['options' => ['class' => 'form-control']])->hint('Klik pada gambar captcha jika tidak terbaca') ?>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary btn-lg']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
