<?php

use common\models\Toko;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Toko */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="toko-form">

<?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL,'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],'options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_toko')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'skuprefix1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'skuprefix2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'skuprefix3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'skuprefix4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'skuprefix5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'skuprefix6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'skuprefix7')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'skuprefix8')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'skuprefix9')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'skuprefix10')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
