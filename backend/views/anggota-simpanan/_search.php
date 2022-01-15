<?php

use common\models\VariabelSimpanan;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AnggotaSimpananSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anggota-simpanan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'type' => ActiveForm::TYPE_INLINE,
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>

    <?= $form->field($model, 'anggota_id') ?>

    <?= $form->field($model, 'simpanan')->dropDownList(ArrayHelper::map(VariabelSimpanan::find()->all(),'simpanan','simpanan'),['prompt'=>'--Semua--']) ?>

    <?= $form->field($model, 'debitkredit')->dropDownList(['kredit' => 'Kredit', 'debit' => 'Debit'],['prompt'=>'--Semua--']) ?>
    

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
