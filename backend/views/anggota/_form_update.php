<?php

use common\models\VariabelAgama;
use common\models\VariabelPendidikanterakhir;
use common\models\VariabelStatuskaryawan;
use common\models\VariabelUnit;
use kartik\widgets\DatePicker;
use kartik\widgets\FileInput;
use kartik\widgets\Select2; // or kartik\select2\Select2
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use kartik\widgets\ActiveForm;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model common\models\Anggota */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anggota-form">

    <?php $form = ActiveForm::begin([
    //'id' => 'form-signup', 
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>

    <?= $form->field($model, 'foto')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
    ]); ?>

    <?= $form->field($model, 'foto_ktp')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
    ]); ?>

    <?php
    $url = \yii\helpers\Url::to(['anggota/select-karyawan-pnj']);

    $karyawan_pnj = empty($model->nomor_pegawai) ? '' : $model->nomor_pegawai;

    echo $form->field($model, 'nomor_pegawai')->widget(Select2::classname(), [
        'initValueText' => $karyawan_pnj, // set the initial display text
        'options' => ['placeholder' => 'Masukan sebagian nama....'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 3,
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

    <?= $form->field($model, 'status_karyawan')->dropDownList(ArrayHelper::map(VariabelStatuskaryawan::find()->all(),'statuskaryawan','statuskaryawan'),['prompt'=>'--Pilih--']) ?>

    <?= $form->field($model, 'unit')->dropDownList(ArrayHelper::map(VariabelUnit::find()->all(),'unit','unit'),['prompt'=>'--Pilih--']) ?>

    <?= $form->field($model, 'nomor_ktp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_lengkap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_lahir')->widget(DatePicker::classname(), ['options' => ['placeholder' => 'Format YYYY-MM-DD'],'pluginOptions' => ['autoclose'=>true,'format' => 'yyyy-mm-dd'],'disabled'=>($model->scenario == 'update')? TRUE : FALSE]) ?>

    <?= $form->field($model, 'jenis_kelamin')->dropDownList(['L' => 'Laki-Laki', 'P' => 'Perempuan'],['prompt'=>'--Pilih--']) ?>

    <?= $form->field($model, 'agama')->dropDownList(ArrayHelper::map(VariabelAgama::find()->all(),'agama','agama'),['prompt'=>'--Pilih--']) ?>

    <?= $form->field($model, 'pendidikanterakhir')->dropDownList(ArrayHelper::map(VariabelPendidikanterakhir::find()->all(),'pendidikanterakhir','pendidikanterakhir'),['prompt'=>'--Pilih--']) ?>

    <?= $form->field($model, 'alamat_rumah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nomor_npwp')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
