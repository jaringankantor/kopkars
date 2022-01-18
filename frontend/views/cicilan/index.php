<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CicilanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cicilan Pinjaman';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cicilan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'kanal_cicilan',
            //'nomor_referensi',
            'cicilan:currency',
            //'keterangan',
            'waktu:date',
            //'last_waktu_update',
            //'insert_by',
            //'last_update_by',
            //'is_deleted:boolean',
            //'deleted_at',
            //'last_softdelete_by',
        ],
        'options'=>['class'=>'box-body table-responsive no-padding'],
    ]); ?>


</div>
