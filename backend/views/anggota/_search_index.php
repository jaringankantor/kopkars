<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AnggotaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anggota-search">

    <?php $form = ActiveForm::begin([
        //'id' => 'form-signup',
        'action' => ['index'],
        'method' => 'get',
        'type' => ActiveForm::TYPE_INLINE,
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>

	<?= $form->field($model, 'keyword') ?>

    <?= $form->field($model, 'status')->dropDownList(['Aktif' => 'Aktif', 'Non Aktif' => 'Non Aktif'],['prompt'=>'--Semua--']) ?>

    <div class="form-group">
        <?= Html::submitButton('Cari Data', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
