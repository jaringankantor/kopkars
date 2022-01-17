<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PinjamanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pinjaman Anggota Kepada Koperasi';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pinjaman-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            //'id',
            //'kode_toko',
            //'anggota_id',
            'saldo_pokok:currency',
            'saldo_jasa:currency',
            'total_pembayaran:currency',
            //'mulai_tanggal_pembayaran',
            //'rencana_tanggal_pelunasan',
            //'aktual_tanggal_pelunasan',
            'peruntukan',
            //'keterangan',
            'waktu:date',
            //'last_waktu_update',
            //'insert_by',
            //'last_update_by',
            //'is_deleted:boolean',
            //'deleted_at',
            //'last_softdelete_by',
            //'nomor_referensi',
        ],
    ]); ?>


</div>
