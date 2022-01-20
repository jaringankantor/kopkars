<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PinjamanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pinjamen';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pinjaman-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pinjaman', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'kode_toko',
            'anggota_id',
            'saldo_pokok',
            'saldo_jasa',
            //'total_pembayaran',
            //'mulai_tanggal_pembayaran',
            //'rencana_tanggal_pelunasan',
            //'aktual_tanggal_pelunasan',
            //'peruntukan',
            //'keterangan',
            //'waktu',
            //'last_waktu_update',
            //'insert_by',
            //'last_update_by',
            //'is_deleted:boolean',
            //'deleted_at',
            //'last_softdelete_by',
            //'nomor_referensi',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
