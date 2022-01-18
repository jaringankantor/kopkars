<?php

use common\models\HistoriAnggotaSimpanan;
use kartik\export\ExportMenu;
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

    <br>

    <?php

    $gridColumns = [
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
        'last_waktu_update',

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
    ]);
    
    ?>


</div>
