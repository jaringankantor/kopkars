<?php

use kartik\editable\Editable;
use kartik\export\ExportMenu;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AnggotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Anggota Aktif';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anggota-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search_index', ['model' => $searchModel]); ?>

    <br>

    <?php

    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],

        'nomor_anggota',
        'nama_lengkap',
        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'email',
            'editableOptions' => [
                'formOptions' => [
                    'action' => Url::to(['/anggota/updateemail-editable-json']),
                ],
            ],
        ],
        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'nomor_hp',
            'value'=>function($model, $key, $index){
                return Yii::$app->kopkarstext->hp62($model->nomor_hp);
            },
            'editableOptions' => [
                'formOptions' => [
                    'action' => Url::to(['/anggota/updatehp-editable-json']),
                ],
            ],
        ],
        //[
        //    'attribute'=>'Informasi Kontak',
        //    'format'=>'raw',
        //    'value'=>function($model, $key, $index)
        //    {return 'Email: '.$model->email.'<br>No HP: '.Yii::$app->kopkarstext->hp62($model->nomor_hp);},
        //],

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete}',
            'buttons' =>
                [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, ['title' => Yii::t('app', 'lead-view'),]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,
                        ['title' => Yii::t('app', 'lead-update'),]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,
                        ['title' => Yii::t('app', 'lead-delete'),]);
                    }
                ],
            'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {
                    return ['anggota/view-biodata','id'=>$model->id];
                }
                if ($action === 'update') {
                    return ['anggota/update','id'=>$model->id];
                }
                if ($action === 'delete') {
                    return ['anggota/delete','id'=>$model->id];
                }
            },
            'visibleButtons' =>
                [
                    'delete' => function ($model, $key, $index) {
                        return empty($model->nomor_anggota) ? true : false;
                    }
                ]
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
