<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TokoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="toko-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'kode') ?>

    <?= $form->field($model, 'nama_toko') ?>

    <?= $form->field($model, 'skuprefix1') ?>

    <?= $form->field($model, 'skuprefix2') ?>

    <?= $form->field($model, 'skuprefix3') ?>

    <?php // echo $form->field($model, 'skuprefix4') ?>

    <?php // echo $form->field($model, 'skuprefix5') ?>

    <?php // echo $form->field($model, 'skuprefix6') ?>

    <?php // echo $form->field($model, 'skuprefix7') ?>

    <?php // echo $form->field($model, 'skuprefix8') ?>

    <?php // echo $form->field($model, 'skuprefix9') ?>

    <?php // echo $form->field($model, 'skuprefix10') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
