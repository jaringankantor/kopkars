<?php

//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Produk */

$this->title = 'Setting Bukalapak';
?>
<div class="setting">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>Halaman ini belum diterapkan untuk perubahan pengiriman (tidak berdampak jika diubah), masih development.</p>

    <div class="marketplace-form">

        <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL,'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],'options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'url_toko')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'header_produk')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'footer_produk')->textarea(['rows' => 6]) ?>

        <?= $form->field($model,'ekspedisi_jne_reg')->checkbox() ?>
        <?= $form->field($model,'ekspedisi_ninja_fast')->checkbox() ?>
        <?= $form->field($model,'ekspedisi_ninja_reg')->checkbox() ?>
        <?= $form->field($model,'ekspedisi_gosend_sameday')->checkbox() ?>
        <?= $form->field($model,'ekspedisi_paxel_sameday')->checkbox() ?>
        <?= $form->field($model,'ekspedisi_grabexpress_instant')->checkbox() ?>
        <?= $form->field($model,'ekspedisi_pos_kilat_khusus')->checkbox() ?>
        <?= $form->field($model,'ekspedisi_jne_yes')->checkbox() ?>
        <?= $form->field($model,'ekspedisi_pos_nextday')->checkbox() ?>
        <?= $form->field($model,'ekspedisi_lionparcel_onepack')->checkbox() ?>
        <?= $form->field($model,'ekspedisi_rpx_nextday')->checkbox() ?>
        <?= $form->field($model,'ekspedisi_grabexpress_rush_delivery')->checkbox() ?>
        <?= $form->field($model,'ekspedisi_sicepat_best')->checkbox() ?>
        <?= $form->field($model,'ekspedisi_sicepat_reg')->checkbox() ?>
        <?= $form->field($model,'ekspedisi_pelapak')->checkbox() ?>
        <?= $form->field($model,'ekspedisi_tiki_ons')->checkbox() ?>
        <?= $form->field($model,'ekspedisi_lionparcel_regpack')->checkbox() ?>
        <?= $form->field($model,'ekspedisi_rpx_economy')->checkbox() ?>
        <?= $form->field($model,'ekspedisi_jne_trucking')->checkbox() ?>
        <?= $form->field($model,'ekspedisi_tiki_reg')->checkbox() ?>
        <?= $form->field($model,'ekspedisi_wahana')->checkbox() ?>
        <?= $form->field($model,'ekspedisi_gosend_instant')->checkbox() ?>
        <?= $form->field($model,'ekspedisi_alfatrex_reg')->checkbox() ?>
        <?= $form->field($model,'ekspedisi_jnt_reg')->checkbox() ?>
        <?= $form->field($model,'ekspedisi_pickup')->checkbox() ?>
        <?= $form->field($model,'ekspedisi_alfatrex_nextday')->checkbox() ?>
        <?= $form->field($model,'ekspedisi_grabexpress_sameday')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
