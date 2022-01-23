<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dana Simpanan Anggota';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anggota-simpanan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php

    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        'simpanan',
        //'rupiah:currency',
        [
            'attribute' => 'rupiah',
            'format' => 'currency',
            'pageSummary' => true
        ],
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
            '{toggleData}',
            '{export}',
        ],
        'exportConfig' => [
            'xls' => [],
        ],
        'options'=>['class'=>'box-body table-responsive no-padding'],
    ]); ?>


</div>
