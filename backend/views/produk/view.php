<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Produk */

$this->title = $model->sku;
$this->params['breadcrumbs'][] = ['label' => 'Produks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="produk-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'sku' => $model->sku], ['class' => 'btn btn-primary']) ?> <?= Html::a('Create', ['create', 'sku' => $model->sku], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sku',
            'status_aktif:boolean',
            'nama_produk',
            'nama_produk_pendek',
            [
                'label'=>'Deskripsi',
                'format'=>'raw',
                'value'=>'<pre>'.$model->deskripsi.'</pre>',
            ],
            'harga_modal_async',
            'harga_async',
            'stok_async',
            'berat',
            [
                'label'=>'Foto',
                'format'=>'raw',
                'value'=>'<img width="300" src="data:image/png;base64,'.base64_encode(hex2bin(stream_get_contents($model->foto_1))).'"> <img width="300" src="data:image/png;base64,'.base64_encode(hex2bin(stream_get_contents($model->foto_2))).'"> <img width="300" src="data:image/png;base64,'.base64_encode(hex2bin(stream_get_contents($model->foto_3))).'"> <img width="300" src="data:image/png;base64,'.base64_encode(hex2bin(stream_get_contents($model->foto_4))).'"> <img width="300" src="data:image/png;base64,'.base64_encode(hex2bin(stream_get_contents($model->foto_5))).'">',
            ],
            ['label'=>'Rekomendasi 1','value'=>$model->rekomendasi1->nama_produk],
            ['label'=>'Rekomendasi 2','value'=>$model->rekomendasi2->nama_produk],
            ['label'=>'Rekomendasi 3','value'=>$model->rekomendasi3->nama_produk],
            ['label'=>'Rekomendasi 4','value'=>$model->rekomendasi4->nama_produk],
            ['label'=>'Rekomendasi 5','value'=>$model->rekomendasi5->nama_produk],
            'video_url_1:url',
            'video_url_2:url',
            'video_url_3:url',
            'video_url_4:url',
            'video_url_5:url',
            'urlid_bli:url',
            'urlid_bkl:url',
            'urlid_fbc:url',
            'urlid_fbm:url',
            'urlid_jdi:url',
            'urlid_lzd:url',
            'urlid_shp:url',
            'urlid_tkp:url',
            'id_tkp',
        ],
    ]) ?>

</div>
