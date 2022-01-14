<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Simpanan Anggota';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anggota-simpanan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['label'=>'Nama Anggota Kopkars', 'value'=>function ($model, $index, $widget) { return $model->anggota->nama_lengkap; }],
            'simpanan',
            'debitkredit',
            'rupiah',
            //'keterangan',
            'waktu:datetime',
            //'last_waktu_update',
            //'insert_by',
            //'last_update_by',
            //'is_deleted:boolean',
            //'deleted_at',
            //'last_softdelete_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
