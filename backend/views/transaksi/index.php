<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transaksi';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksi-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'kanal_transaksi',
            'nomor_referensi',
            //'nomor_pesanan',
            //'anggota_id',
            //'anggota_nomor_zahir',
            ['label'=>'Nama Anggota Kopkars', 'value'=>function ($model, $index, $widget) { return $model->anggotaById->nama_lengkap; }],
            'nama_pelanggan',
            //'mata_uang',
            //'subtotal',
            //'diskon',
            //'pajak',
            'total_penjualan:currency',
            'pembayaran',
            'saldo',
            'keterangan',
            //'waktu',
            //'last_waktu_update',
            //'insert_by',
            //'last_update_by',
            //'is_deleted:boolean',
            //'deleted_at',
            //'last_softdelete_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
