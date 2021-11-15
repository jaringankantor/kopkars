<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Anggota */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Anggotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="anggota-view">

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
            'status',
            'status_karyawan',
            'nomor_anggota',
            'nomor_pegawai',
            'email:email',
            'email_last_lock:email',
            'email_last_lock_verified:boolean',
            'password_default',
            'foto',
            'foto_thumbnail',
            'unit',
            'nomor_hp',
            'nomor_hp_last_lock',
            'nomor_hp_last_lock_verified:boolean',
            'nomor_ktp',
            'nama_lengkap',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'agama',
            'pendidikanterakhir',
            'alamat_rumah',
            'nomor_npwp',
            'keterangan',
            'tanggal_daftar',
            'tanggal_update',
            'tanggal_login',
            'tanggal_approve',
            'approved_by',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'verification_token',
        ],
    ]) ?>

</div>
