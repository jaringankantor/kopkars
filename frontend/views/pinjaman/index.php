<?php

use common\models\Cicilan;
use common\models\Pinjaman;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PinjamanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pinjaman Anggota Kepada Koperasi';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pinjaman-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php

    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        //'saldo_pokok:currency',
        [
            'attribute' => 'saldo_pokok',
            'format' => 'currency',
            'pageSummary' => true
        ],
        //'saldo_jasa:currency',
        [
            'attribute' => 'saldo_jasa',
            'format' => 'currency',
            'pageSummary' => true
        ],
        //'total_pembayaran:currency',
        [
            'attribute' => 'total_pembayaran',
            'format' => 'currency',
            'pageSummary' => true
        ],
        'peruntukan',
        'waktu:date',
    ];

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'headerContainer' => ['class' => 'kv-table-header'],
        //'containerOptions' => ['class' => 'kv-grid-wrapper'], // fixed height for floated header behavior
        //'floatHeader' => true, // table header floats when you scroll
        //'floatPageSummary' => true, // table page summary floats when you scroll
        'showPageSummary' => true,
        'responsive' => true,
        'condensed' => true,
        'hover' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<h3 class="panel-title"><i class="fas fa-book"></i> '.$this->title.'</h3>',
        ],
        'exportContainer' => [
            'class' => 'btn-group mr-2 me-2'
        ],
        'toolbar' => [
            '{export}',
        ],
        'exportConfig' => [
            'xls' => [],
        ],
        'options'=>['class'=>'box-body table-responsive no-padding'],
    ]);
    ?>

    <h1>Resume Pinjaman-Cicilan</h1>

    <?php
    
    $array_resume_pinjaman_cicilan = [
        [
        'data_pinjaman_per'=>Pinjaman::frontendTanggalPinjamanTerakhir(),
        'total_pinjaman'=>Pinjaman::frontendTotalPinjaman(),
        'data_cicilan_per'=>Cicilan::frontendTanggalCicilanTerakhir(),
        'total_cicilan'=>Cicilan::frontendTotalCicilan(),
        'sisa_cicilan'=>Pinjaman::frontendTotalPinjaman()-Cicilan::frontendTotalCicilan(),
        ]
    ];

    $dataProvider = new ArrayDataProvider([
        'allModels' => $array_resume_pinjaman_cicilan,
        'pagination' => false,
    ]);

    echo '<h2>Pinjaman</h2>';
    echo GridView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
        'columns' => [
            ['label'=>'Data Pinjaman Per','format'=>'date','value'=>'data_pinjaman_per'],
            ['label'=>'Total Pinjaman','format'=>'currency','value'=>'total_pinjaman'],
        ],
    ]);

    echo '<h2>Cicilan</h2>';
    echo GridView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
        'columns' => [
            ['label'=>'Data Cicilan Per','format'=>'date','value'=>'data_cicilan_per'],
            ['label'=>'Total Cicilan','format'=>'currency','value'=>'total_cicilan'],
        ],
    ]);

    echo '<h2>Pinjaman Belum Lunas</h2>';
    echo GridView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
        'columns' => [
            ['label'=>'Data Sisa Pinjaman Per','format'=>'date','value'=>'data_cicilan_per'],
            ['label'=>'Total Sisa Cicilan','format'=>'currency','value'=>'sisa_cicilan'],
        ],
    ]);
    ?>


</div>
