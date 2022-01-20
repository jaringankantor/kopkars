<?php

use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JsExpression;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PinjamanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pinjaman-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'type' => ActiveForm::TYPE_INLINE,
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>

    <?php
    $url = \yii\helpers\Url::to(['anggota/select-anggota']);

    $anggota = empty($model->anggota_id) ? '' : $model->anggota->nomor_anggota.'-'.$model->anggota->nama_lengkap.'-'.$model->anggota->unit;

    echo $form->field($model, 'anggota_id')->widget(Select2::classname(), [
        'initValueText' => $anggota, // set the initial display text
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

<div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
