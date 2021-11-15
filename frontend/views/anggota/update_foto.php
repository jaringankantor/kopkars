<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;

$this->title = 'Update Data Foto';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anggota-update-hp">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><p>Silahkan pilih foto wajah Anda.</p></p>

    <div class="anggota-form">

    <?php $form = ActiveForm::begin([
    //'id' => 'form-signup',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],
    'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?php
	if (empty($model->foto)){
        echo $form->field($model, 'foto')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
        ]);
    } else {
        echo $form->field($model, 'foto')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview'=>[
                    '<img src="data:image/png;base64,'.base64_encode(hex2bin(stream_get_contents($model->foto))).'" class="kv-preview-data file-preview-image">',
                ],
                'initialPreviewAsData'=>false,
                'overwriteInitial'=>true,
                'initialPreviewFileType'=>'image',
            ]
        ]);
    }
	?>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary btn-lg']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    </div>
</div>
