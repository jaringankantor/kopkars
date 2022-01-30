<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PesananPinjaman */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pesanan Pinjamen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pesanan-pinjaman-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'kode_toko',
            'anggota_id',
            'nomor_referensi',
            'saldo_pokok',
            'saldo_jasa',
            'total_pembayaran',
            'mulai_tanggal_pembayaran',
            'rencana_tanggal_pelunasan',
            'aktual_tanggal_pelunasan',
            'peruntukan',
            'lampiran',
            'keterangan',
            'waktu',
            'last_update_by',
            'is_approved_level1:boolean',
            'is_approved_level2:boolean',
            'is_processed:boolean',
        ],
    ]) ?>

</div>
