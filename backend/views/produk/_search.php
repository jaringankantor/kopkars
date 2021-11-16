<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProdukSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produk-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'sku') ?>

    <?= $form->field($model, 'status_aktif')->checkbox() ?>

    <?= $form->field($model, 'nama_produk') ?>

    <?= $form->field($model, 'deskripsi') ?>

    <?= $form->field($model, 'harga_async') ?>

    <?php // echo $form->field($model, 'stok_async') ?>

    <?php // echo $form->field($model, 'berat') ?>

    <?php // echo $form->field($model, 'foto_1') ?>

    <?php // echo $form->field($model, 'foto_2') ?>

    <?php // echo $form->field($model, 'foto_3') ?>

    <?php // echo $form->field($model, 'foto_4') ?>

    <?php // echo $form->field($model, 'foto_5') ?>

    <?php // echo $form->field($model, 'foto_6') ?>

    <?php // echo $form->field($model, 'foto_7') ?>

    <?php // echo $form->field($model, 'video_url_1') ?>

    <?php // echo $form->field($model, 'video_url_2') ?>

    <?php // echo $form->field($model, 'video_url_3') ?>

    <?php // echo $form->field($model, 'video_url_4') ?>

    <?php // echo $form->field($model, 'video_url_5') ?>

    <?php // echo $form->field($model, 'rekomendasi_1') ?>

    <?php // echo $form->field($model, 'rekomendasi_2') ?>

    <?php // echo $form->field($model, 'rekomendasi_3') ?>

    <?php // echo $form->field($model, 'rekomendasi_4') ?>

    <?php // echo $form->field($model, 'rekomendasi_5') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
