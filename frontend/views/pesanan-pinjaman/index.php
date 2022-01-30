<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pesanan Pinjamen';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pesanan-pinjaman-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pesanan Pinjaman', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'kode_toko',
            'anggota_id',
            'nomor_referensi',
            'saldo_pokok',
            //'saldo_jasa',
            //'total_pembayaran',
            //'mulai_tanggal_pembayaran',
            //'rencana_tanggal_pelunasan',
            //'aktual_tanggal_pelunasan',
            //'peruntukan',
            //'lampiran',
            //'keterangan',
            //'waktu',
            //'last_update_by',
            //'is_approved_level1:boolean',
            //'is_approved_level2:boolean',
            //'is_processed:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
