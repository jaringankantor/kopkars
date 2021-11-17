<?php

use yii\helpers\Html;
use common\models\Produk;
use common\models\Toko;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use kartik\widgets\Select2; // or kartik\select2\Select2
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model backend\models\Produk */
/* @var $form yii\widgets\ActiveForm */

$toko=Toko::findOne(['kode'=>Yii::$app->user->identity->kode_toko]);

$text_skuprefix='';
foreach ($toko->attributes as $key => $value) {
    if(substr($key,0,9)=='skuprefix'&&!empty($value)){
        $text_skuprefix .=$value.'0001, ';
    }
}
$text_skuprefix = rtrim($text_skuprefix,', ');

?>

<div class="produk-form">

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL,'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],'options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'sku')->textInput(['maxlength' => true])->hint('Contoh: '.$text_skuprefix) ?>

    <?php
    $model->status_aktif = true;
    echo $form->field($model, 'status_aktif')->checkbox()
    ?>

    <?= $form->field($model, 'nama_produk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'warna')->dropDownList(['Multicolor' => 'Multicolor', 'Merah' => 'Merah', 'Kuning' => 'Kuning', 'Hijau' => 'Hijau', 'Biru' => 'Biru', 'Putih' => 'Putih', 'Hitam' => 'Hitam', 'Ungu' => 'Ungu']) ?>

    <?= $form->field($model, 'deskripsi')->textArea(['rows' => 6]) ?>

    <?= $form->field($model, 'harga_async')->textInput() ?>

    <?= $form->field($model, 'stok_async')->textInput() ?>

    <?= $form->field($model, 'berat')->textInput() ?>

    <?php
    $url = \yii\helpers\Url::to(['produk/select-produk']);
    
    $produk = empty($model->rekomendasi_1) ? '' : Produk::findOneProduk($model->rekomendasi_1)->nama_produk;

    echo $form->field($model, 'rekomendasi_1')->widget(Select2::classname(), [
        'initValueText' => $produk, // set the initial display text
        'options' => ['placeholder' => 'Input nama produk....'],
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
            'templateResult' => new JsExpression('function(produk) { return produk.text; }'),
            'templateSelection' => new JsExpression('function (produk) { return produk.text; }'),
        ],
    ]);
    ?>

    <?php
    $url = \yii\helpers\Url::to(['produk/select-produk']);
    
    $produk = empty($model->rekomendasi_2) ? '' : Produk::findOneProduk($model->rekomendasi_2)->nama_produk;

    echo $form->field($model, 'rekomendasi_2')->widget(Select2::classname(), [
        'initValueText' => $produk, // set the initial display text
        'options' => ['placeholder' => 'Input nama produk....'],
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
            'templateResult' => new JsExpression('function(produk) { return produk.text; }'),
            'templateSelection' => new JsExpression('function (produk) { return produk.text; }'),
        ],
    ]);
    ?>

    <?php
    $url = \yii\helpers\Url::to(['produk/select-produk']);
    
    $produk = empty($model->rekomendasi_3) ? '' : Produk::findOneProduk($model->rekomendasi_3)->nama_produk;

    echo $form->field($model, 'rekomendasi_3')->widget(Select2::classname(), [
        'initValueText' => $produk, // set the initial display text
        'options' => ['placeholder' => 'Input nama produk....'],
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
            'templateResult' => new JsExpression('function(produk) { return produk.text; }'),
            'templateSelection' => new JsExpression('function (produk) { return produk.text; }'),
        ],
    ]);
    ?>

    <?php
    $url = \yii\helpers\Url::to(['produk/select-produk']);
    
    $produk = empty($model->rekomendasi_4) ? '' : Produk::findOneProduk($model->rekomendasi_4)->nama_produk;

    echo $form->field($model, 'rekomendasi_4')->widget(Select2::classname(), [
        'initValueText' => $produk, // set the initial display text
        'options' => ['placeholder' => 'Input nama produk....'],
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
            'templateResult' => new JsExpression('function(produk) { return produk.text; }'),
            'templateSelection' => new JsExpression('function (produk) { return produk.text; }'),
        ],
    ]);
    ?>

    <?php
    $url = \yii\helpers\Url::to(['produk/select-produk']);
    
    $produk = empty($model->rekomendasi_5) ? '' : Produk::findOneProduk($model->rekomendasi_5)->nama_produk;

    echo $form->field($model, 'rekomendasi_5')->widget(Select2::classname(), [
        'initValueText' => $produk, // set the initial display text
        'options' => ['placeholder' => 'Input nama produk....'],
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
            'templateResult' => new JsExpression('function(produk) { return produk.text; }'),
            'templateSelection' => new JsExpression('function (produk) { return produk.text; }'),
        ],
    ]);
    ?>


    <?php
	if (empty($model->foto_1)){
        echo $form->field($model, 'foto_1')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
        ]);
    } else {
        echo $form->field($model, 'foto_1')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview'=>[
                    '<img src="data:image/png;base64,'.base64_encode(hex2bin(stream_get_contents($model->foto_1))).'" class="kv-preview-data file-preview-image">',
                ],
                'initialPreviewAsData'=>false,
                'overwriteInitial'=>true,
                'initialPreviewFileType'=>'image',
            ]
        ]);
    }
	?>

    <?php
	if (empty($model->foto_2)){
        echo $form->field($model, 'foto_2')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
        ]);
    } else {
        echo $form->field($model, 'foto_2')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview'=>[
                    '<img src="data:image/png;base64,'.base64_encode(hex2bin(stream_get_contents($model->foto_2))).'" class="kv-preview-data file-preview-image">',
                ],
                'initialPreviewAsData'=>false,
                'overwriteInitial'=>true,
                'initialPreviewFileType'=>'image',
            ]
        ]);
    }
	?>

    <?php
	if (empty($model->foto_3)){
        echo $form->field($model, 'foto_3')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
        ]);
    } else {
        echo $form->field($model, 'foto_3')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview'=>[
                    '<img src="data:image/png;base64,'.base64_encode(hex2bin(stream_get_contents($model->foto_3))).'" class="kv-preview-data file-preview-image">',
                ],
                'initialPreviewAsData'=>false,
                'overwriteInitial'=>true,
                'initialPreviewFileType'=>'image',
            ]
        ]);
    }
	?>

    <?php
	if (empty($model->foto_4)){
        echo $form->field($model, 'foto_4')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
        ]);
    } else {
        echo $form->field($model, 'foto_4')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview'=>[
                    '<img src="data:image/png;base64,'.base64_encode(hex2bin(stream_get_contents($model->foto_4))).'" class="kv-preview-data file-preview-image">',
                ],
                'initialPreviewAsData'=>false,
                'overwriteInitial'=>true,
                'initialPreviewFileType'=>'image',
            ]
        ]);
    }
	?>

    <?php   
	if (empty($model->foto_5)){
        echo $form->field($model, 'foto_5')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
        ]);
    } else {
        echo $form->field($model, 'foto_5')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview'=>[
                    '<img src="data:image/png;base64,'.base64_encode(hex2bin(stream_get_contents($model->foto_5))).'" class="kv-preview-data file-preview-image">',
                ],
                'initialPreviewAsData'=>false,
                'overwriteInitial'=>true,
                'initialPreviewFileType'=>'image',
            ]
        ]);
    }
	?>

    <?php
	if (empty($model->foto_6)){
        echo $form->field($model, 'foto_6')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
        ]);
    } else {
        echo $form->field($model, 'foto_6')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview'=>[
                    '<img src="data:image/png;base64,'.base64_encode(hex2bin(stream_get_contents($model->foto_6))).'" class="kv-preview-data file-preview-image">',
                ],
                'initialPreviewAsData'=>false,
                'overwriteInitial'=>true,
                'initialPreviewFileType'=>'image',
            ]
        ]);
    }
	?>

    <?php
	if (empty($model->foto_7)){
        echo $form->field($model, 'foto_7')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
        ]);
    } else {
        echo $form->field($model, 'foto_7')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview'=>[
                    '<img src="data:image/png;base64,'.base64_encode(hex2bin(stream_get_contents($model->foto_7))).'" class="kv-preview-data file-preview-image">',
                ],
                'initialPreviewAsData'=>false,
                'overwriteInitial'=>true,
                'initialPreviewFileType'=>'image',
            ]
        ]);
    }
	?>

    <?= $form->field($model, 'video_url_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'video_url_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'video_url_3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'video_url_4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'video_url_5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'urlid_bli')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'urlid_bkl')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'urlid_fbc')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'urlid_fbm')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'urlid_jdi')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'urlid_lzd')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'urlid_shp')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'urlid_tkp')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'id_tkp')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
