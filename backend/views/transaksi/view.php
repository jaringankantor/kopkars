<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Transaksi */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transaksis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="transaksi-view">

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
            'kanal_transaksi',
            'nomor_referensi',
            'nomor_pesanan',
            'anggota_id',
            'anggota_nomor_zahir',
            'nama_pelanggan',
            'mata_uang',
            'subtotal',
            'diskon',
            'pajak',
            'total_penjualan',
            'pembayaran',
            'saldo',
            'keterangan',
            'waktu',
            'last_waktu_update',
            'insert_by',
            'last_update_by',
            'is_deleted:boolean',
            'deleted_at',
            'last_softdelete_by',
        ],
    ]) ?>

</div>
