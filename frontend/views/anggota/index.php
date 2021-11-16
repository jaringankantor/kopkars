<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Anggotas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anggota-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Anggota', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'status',
            'statuskaryawan',
            'nomor_anggota',
            'nomor_pegawai',
            //'email:email',
            //'password_default',
            //'foto',
            //'foto_thumbnail',
            //'unit',
            //'nomor_hp',
            //'nomor_ktp',
            //'nama_lengkap',
            //'tempat_lahir',
            //'tanggal_lahir',
            //'jenis_kelamin',
            //'agama',
            //'pendidikanterakhir',
            //'alamat_rumah',
            //'nomor_npwp',
            //'keterangan',
            //'waktu_daftar',
            //'waktu_update',
            //'waktu_login',
            //'waktu_approve',
            //'approved_by',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
