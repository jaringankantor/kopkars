<?php

use yii\helpers\Html;
use yii\helpers\Url;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\VoucherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Voucher Anggota';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="voucher-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['label'=>'Nama Anggota Kopkars', 'value'=>function ($model, $index, $widget) { return $model->anggota->nama_lengkap; }],
            'kode_voucher',
            //'kode_toko',
            'rupiah:currency',
            'rupiah_terpakai:currency',
            //'berlaku_mulai:date',
            'berakhir_sampai:date',
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'keterangan',
                'value'=>function($model, $key, $index){
                    return $model->keterangan;
                },
                'editableOptions' => [
                    'formOptions' => [
                        'action' => Url::to(['/voucher/update-editable-json']),
                    ],
                ],
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{gunakan}',
                'buttons' => [
                    'gunakan' => function ($url,$model) {
                        if (($model->rupiah_terpakai < $model->rupiah) AND (strtotime($model->berakhir_sampai) > strtotime(date("Y-m-d H:is")))){ 
                            return Html::a('<span class="glyphicon glyphicon-ok"></span> Gunakan', ['ok-gunakan','kode_voucher'=>$model->kode_voucher,'kode_toko'=>$model->kode_toko], ['id'=>'approved-button'.$model->kode_toko.$model->kode_voucher,'class' => 'btn btn-success','data' => ['confirm' => 'Gunakan voucher ini??','method' => 'post']]);
                        } else {
                            return 'Sudah Digunakan';
                        }
                    }
                ],
            ],
        ],
    ]); ?>


</div>
