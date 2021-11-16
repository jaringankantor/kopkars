<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\VariabelMarketplaceEtalaseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="variabel-marketplace-etalase-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'kode_variabel_marketplace') ?>

    <?= $form->field($model, 'kode') ?>

    <?= $form->field($model, 'marketplace_etalase') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
