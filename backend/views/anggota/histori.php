<?php
use common\models\HistoriAnggota;
use common\models\VariabelStatus;
use kartik\editable\Editable;
use kartik\export\ExportMenu;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AnggotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Histori Anggota';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anggota-status">

    <h1><?= Html::encode($this->title) ?></h1>

    <p><a href="https://datastudio.google.com/u/0/reporting/abd7a6c3-5062-4dc5-baf8-de8659532e00/page/p_lyvat87mrc" target="_blank">Rekapitulasi Perubahan Anggota</a></p>

    <?php echo $this->render('_search_histori', ['model' => $searchModel]); ?>

    <br>

    <?php
    $gridColumns = [
        ['class' => 'kartik\grid\SerialColumn'],

            'nomor_anggota',
            'nomor_pegawai',
            'nama_lengkap',
            [
                'attribute'=>'Histori',
                'format'=>'raw',
                'value'=>function($model, $key, $index)
                {
                    $query = HistoriAnggota::find()->where(['anggota_id'=>$model->id])->all();
                    $historianggota = NULL;
                    foreach ($query as $row) {
                        $historianggota .= $row['anggota_kolom'].': '.$row['value_old'].' => '.$row['value_new'].' ('.$row['waktu_update'].')<br>';
                    
                    }

                    return $historianggota;
                },
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'status',
                'editableOptions' => [
                    'formOptions' => [
                        'action' => Url::to(['/anggota/updatestatus-editable-json']),
                    ],
                    'inputType' => Editable::INPUT_DROPDOWN_LIST,
                    'data' => ArrayHelper::map(VariabelStatus::find()->all(),'status','status'),
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
        //'filterModel' => $searchModel,
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
