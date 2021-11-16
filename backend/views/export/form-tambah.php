<?php
use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

?>

<div class="produk-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>Silahkan ceklis produk di bawah ini kemudian klik tombol export</p>

    <?= Html::beginForm(['tambah-tokopedia'], 'post', ['id'=>'form-export','target' => '_blank']) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => '\kartik\grid\CheckboxColumn',
                'name'=>'sku[]',
                'checkboxOptions' => function($model, $key, $index, $widget) {
                    return ["value" => $model->sku];
                
                },
            ],
            'sku',
            'nama_produk',
            'harga_async',
            'stok_async',
            'berat',
        ],
        'options'=>['class'=>'box-body table-responsive no-padding'],
    ]);?>
    <div class="form-group">
        <?php
        echo Html::a('Export Tambah Blibli', ['tambah-blibli'], [
            'class' => 'btn btn-primary',
            'data' => [
                'method' => 'post'
            ]
        ]);
        echo ' ';
        echo Html::a('Export Tambah Bukalapak (maks 3 kategori)', ['tambah-bukalapak'], [
            'class' => 'btn btn-primary',
            'data' => [
                'method' => 'post'
            ]
        ]);
        echo ' ';
        echo Html::a('Export Elevenia', ['tambah-elevenia'], [
            'class' => 'btn btn-primary',
            'data' => [
                'method' => 'post'
            ]
        ]);
        echo ' ';
        echo Html::a('Export Tambah JDID', ['tambah-jdid'], [
            'class' => 'btn btn-primary',
            'data' => [
                'method' => 'post'
            ]
        ]);
        echo ' ';
        echo ' ';
        echo Html::a('Export Tambah Lazada', ['tambah-lazada'], [
            'class' => 'btn btn-primary',
            'data' => [
                'method' => 'post'
            ]
        ]);
        echo ' ';
        echo Html::a('Export Tambah Shopee', ['tambah-shopee'], [
            'class' => 'btn btn-primary',
            'data' => [
                'method' => 'post'
            ]
        ]);
        echo ' ';
        echo Html::a('Export Tambah Tokopedia', ['tambah-tokopedia'], [
            'class' => 'btn btn-primary',
            'data' => [
                'method' => 'post'
            ]
        ]);
        echo ' ';
        echo Html::a('Export Tambah Zobaze', ['tambah-zobaze'], [
            'class' => 'btn btn-primary',
            'data' => [
                'method' => 'post'
            ]
        ]);
        ?>
    </div>
    <?= Html::endForm() ?>

</div>