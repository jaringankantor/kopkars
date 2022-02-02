<?php

use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\helpers\Url;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PesananPinjamanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pesanan Pinjaman';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pesanan-pinjaman-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php

    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],

            ['label'=>'Nama Anggota Kopkars', 'value'=>function ($model, $index, $widget) { return $model->anggota->nama_lengkap; }],
            'nomor_referensi',
            'saldo_pokok',
            'saldo_jasa',
            'total_pembayaran',
            'is_approved_level1:boolean',
            'is_approved_level2:boolean',

            ['class' => 'yii\grid\ActionColumn']
    ];

    $customDropdown = [
        //'linkOptions' => ['class' => 'dropdown-item']
    ];

    $fullExportMenu = ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'target' => ExportMenu::TARGET_BLANK,
        'asDropdown' => false, // this is important for this case so we just need to get a HTML list 
        'exportConfig' => [ // set styling for your custom dropdown list items
            ExportMenu::FORMAT_CSV => $customDropdown,
            ExportMenu::FORMAT_TEXT => $customDropdown,
            ExportMenu::FORMAT_HTML => $customDropdown,
            ExportMenu::FORMAT_PDF => $customDropdown,
            ExportMenu::FORMAT_EXCEL => $customDropdown,
            ExportMenu::FORMAT_EXCEL_X => $customDropdown,
        ],
    ]);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
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
        'export' => [
            'itemsAfter'=> [
                '<div role="presentation" class="dropdown-divider"></div>',
                '<div class="dropdown-header">Export All Data</div>',
                $fullExportMenu
            ]
        ],
        'options'=>['class'=>'box-body table-responsive no-padding'],
    ]); ?>


</div>
