<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\IuranRutinAnggota;
use common\models\Tagihan;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pemberian Nomor Anggota';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anggota-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>Pastikan data dan foto anggota sudah lengkap sebelum memberikan nomor anggota</p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'nama_lengkap',
                'format'=>'raw',
                'value'=>function($model, $key, $index)
                {return $model->nama_lengkap.' '.Html::a('<span class="glyphicon glyphicon  glyphicon glyphicon-pencil "></span> Ubah Data', ['update','id'=>$model->id]);},
            ],
            [
                'attribute'=>'Informasi Kontak',
                'format'=>'raw',
                'value'=>function($model, $key, $index)
                {return 'Email: '.$model->email.'<br>No HP: +62'.$model->nomor_hp;},
            ],
            'waktu_daftar:datetime',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{approved} {tolak}',
                'buttons' => [
                    'approved' => function ($url,$model) {
                        if (empty($model->waktu_approve)) return Html::a('<span class="glyphicon glyphicon-ok"></span> Berikan Nomor', ['ok-beri-nomor','id'=>$model->id], ['id'=>'approved-button'.$model->id,'class' => 'btn btn-success','data' => ['confirm' => 'Apakah sudah melakukan approval data dan menyetujui keanggotaan ini?','method' => 'post']]);
                        },
                    'tolak' => function ($url,$model) {
                        if (empty($model->waktu_approve)) return Html::a('<span class="glyphicon glyphicon-remove"></span> Tolak Keanggotaan', ['delete','id'=>$model->id], ['id'=>'tolak-button'.$model->id,'class' => 'btn btn-danger','data' => ['confirm' => 'Yakin tolak keanggotaan ini?','method' => 'post']]);
                        },
                ],
            ],
        ],
        'options'=>['class'=>'box-body table-responsive no-padding'],
    ]); ?>
</div>
