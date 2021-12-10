<?php

use kartik\editable\Editable;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;


$this->title = 'List Produk';

?>

<div class="col-md-3">
    <?= $this->render('_menu-kiri') ?>
</div>

<div class="col-md-8">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'sku',
            'status_aktif:boolean',
            'nama_produk',
            //'deskripsi',
            //'stok_async',
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'stok_async',
                'editableOptions' => [
                    'formOptions' => [
                        'action' => Url::to(['/produk/update-editable-json']),
                    ],
                    'inputType' => Editable::INPUT_SPIN,
                    'options' => [
                        'pluginOptions' => ['min' => 0, 'max' => 100],
                    ],
                ],
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'harga_async',
                'editableOptions' => [
                    'formOptions' => [
                        'action' => Url::to(['/produk/update-editable-json']),
                    ],
                    'inputType' => Editable::INPUT_SPIN,
                    'options' => [
                        'pluginOptions' => ['min' => 0, 'max' => 2000000],
                    ],
                ],
            ],
            //'harga_async',
            //'berat',
            //'foto_1',
            //'foto_2',
            //'foto_3',
            //'foto_4',
            //'foto_5',
            //'foto_6',
            //'foto_7',
            //'video_url_1:url',
            //'video_url_2:url',
            //'video_url_3:url',
            //'video_url_4:url',
            //'video_url_5:url',
            //'rekomendasi_1',
            //'rekomendasi_2',
            //'rekomendasi_3',
            //'rekomendasi_4',
            //'rekomendasi_5',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update}',
            ],
        ],
    ]); ?>


</div>
