<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dana Simpanan Anggota';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anggota-simpanan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'simpanan',
            'debitkredit',
            'rupiah',
            //'keterangan',
            'waktu',
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
