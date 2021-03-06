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
                'keterangan',
                'waktu_login:date',
                'waktu_update:date',
            ],
        ]) ?>
        </div>
        
        <div class="col-xs-12 col-md-4">
            <?php
            $foto = $model->foto;
            $foto_profil='<img class="img-thumbnail img-responsive" src="'.Url::base().'/public/images/no-image.png">';
            if($foto !== NULL){
                $foto_profil='<img class="img-thumbnail img-responsive" src="data:image/png;base64,'.base64_encode(hex2bin(stream_get_contents($model->foto))).'">';
            }
            echo $foto_profil;
            ?>
        </div>
    </div>

</div>
