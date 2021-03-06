<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Anggota */

$this->title = 'Biodata '.$model->nama_lengkap;
//$this->params['breadcrumbs'][] = ['label' => 'Anggotas', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="anggota-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?= Html::a('<span class="glyphicon glyphicon-envelope"></span> Update Email', ['update-email'], ['class' => 'btn btn-success']) ?> <?= Html::a('<span class="glyphicon glyphicon-phone"></span> Update Nomor HP', ['update-hp'], ['class' => 'btn btn-success']) ?> <?= Html::a('<span class="glyphicon glyphicon-user"></span>  Update Biodata', ['update'], ['class' => 'btn btn-success']) ?> <?= Html::a('<span class="glyphicon glyphicon-qrcode"></span>  Reset Password', ['site/request-password-reset'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="row">
        <div class="col-xs-12 col-md-8">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'status',
                'status_karyawan',
                'nomor_anggota',
                'nomor_pegawai',
                'email:email',
                'unit',
                ['attribute' => 'nomor_hp','value' => Yii::$app->kopkarstext->hp62($model->nomor_hp)],
                'nomor_ktp',
                'nama_lengkap',
                'tempat_lahir',
                'tanggal_lahir:date',
                'jenis_kelamin',
                'agama',
                'pendidikanterakhir',
                'alamat_rumah',
                'nomor_npwp',
                //'waktu_login:date',
            ],
        ]) ?>
        </div>
        
        <div class="col-xs-12 col-md-4">
            <?= Html::a('<span class="glyphicon glyphicon-camera"></span> Update Foto', ['update-foto'], ['class' => 'btn btn-success']) ?> <?= Html::a('<span class="glyphicon glyphicon-user"></span> Update KTP', ['update-foto-ktp'], ['class' => 'btn btn-success']) ?>
            <?php
            $foto = $model->foto;
            $foto_profil='<img class="img-thumbnail img-responsive" src="'.Url::base().'/public/images/no-image.png">';
            if($foto !== NULL){
                $foto_profil='<img class="img-thumbnail img-responsive" src="data:image/png;base64,'.base64_encode(hex2bin(stream_get_contents($model->foto))).'">';
            }
            echo $foto_profil;
            ?>
            <br>
            <?php
            $foto_ktp = $model->foto_ktp;
            $foto_ktp_tampil='<img class="img-thumbnail img-responsive" src="'.Url::base().'/public/images/no-image.png">';
            if($foto_ktp !== NULL){
                $foto_ktp_tampil='<img class="img-thumbnail img-responsive" src="data:image/png;base64,'.base64_encode(hex2bin(stream_get_contents($model->foto_ktp))).'">';
            }
            echo $foto_ktp_tampil;
            ?>
        </div>
    </div>

</div>
