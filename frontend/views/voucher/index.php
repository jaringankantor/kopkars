<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Voucher Anggota';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="voucher-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'kode_voucher',
            'nama_voucher',
            //'kode_toko',
            //'anggota_id',
            'rupiah:currency',
            'rupiah_terpakai:currency',
            'berlaku_mulai',
            'berakhir_sampai',
        ],
        'options'=>['class'=>'box-body table-responsive no-padding'],
    ]); ?>


</div>
