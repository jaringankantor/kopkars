<?php

use common\models\VariabelMarketplace;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\VariabelMarketplaceEtalase */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="variabel-marketplace-etalase-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_variabel_marketplace')->dropDownList(ArrayHelper::map(VariabelMarketplace::find()->all(),'kode','marketplace'),['prompt'=>'--Pilih--']) ?>

    <?= $form->field($model, 'kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'marketplace_etalase')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
