<?php

use kartik\number\NumberControl;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Produk */

$this->title = 'Setting Elevania';
?>
<div class="setting">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="marketplace-form">

        <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL,'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],'options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'url_toko')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'header_produk')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'footer_produk')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
