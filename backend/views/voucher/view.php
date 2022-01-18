<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Voucher */

$this->title = $model->kode_voucher;
$this->params['breadcrumbs'][] = ['label' => 'Vouchers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="voucher-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'kode_voucher' => $model->kode_voucher, 'kode_toko' => $model->kode_toko], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'kode_voucher' => $model->kode_voucher, 'kode_toko' => $model->kode_toko], [
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
            'kode_voucher',
            'nama_voucher',
            'kode_toko',
            'anggota_id',
            'rupiah',
            'rupiah_terpakai',
            'berlaku_mulai',
            'berakhir_sampai',
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
