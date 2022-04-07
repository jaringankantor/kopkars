<?php
use common\models\HistoriAnggotaSimpanan;
use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\helpers\Url;
//use yii\grid\GridView;
use kartik\grid\GridView;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Simpanan Anggota';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anggota-simpanan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <br>

    <?php
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],

        ['label'=>'Nama Anggota Kopkars', 'value'=>function ($model, $index, $widget) { return $model->anggota->nama_lengkap; }],
        ['label'=>'Nomor Anggota Kopkars', 'value'=>function ($model, $index, $widget) { return $model->anggota->nomor_anggota; }],
        'simpanan',
        //'rupiah:currency',
        [
            'attribute' => 'rupiah',
            'format' => 'currency',
            'pageSummary' => true
        ],
        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'keterangan',
            'value'=>function($model, $key, $index){
                return $model->keterangan;
            },
            'editableOptions' => [
                'formOptions' => [
                    'action' => Url::to(['/anggota-simpanan/update-keterangan-editable-json']),
                ],
            ],
        ],
        'waktu:date',
        [
            'attribute'=>'Histori',
            'format'=>'raw',
            'value'=>function($model, $key, $index)
            {
                $query = HistoriAnggotaSimpanan::find()->where(['anggota_simpanan_id'=>$model->id])->all();
                $historianggotasimpanan = NULL;
                foreach ($query as $row) {
                    $historianggotasimpanan .= $row['anggota_simpanan_kolom'].': '.$row['value_old'].' => '.$row['value_new'].' ('.$row['waktu'].'). <br>';
                
                }

                return $historianggotasimpanan;
            },
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
        'headerContainer' => ['class' => 'kv-table-header'],
        'containerOptions' => ['class' => 'kv-grid-wrapper'], // fixed height for floated header behavior
        'floatHeader' => true, // table header floats when you scroll
        'floatPageSummary' => true, // table page summary floats when you scroll
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
            'pdf' => [],
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
