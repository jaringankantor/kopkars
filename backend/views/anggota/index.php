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

$this->title = 'Anggota';
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
        'status',
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
           'attribute'=>'Kirim WA Info Login',
           'format'=>'raw',
           'value'=>function($model, $key, $index)
           {return 'https://api.whatsapp.com/send?phone=62'.$model->nomor_hp.'&text=Informasi%20Login%20KOPKARS%20PNJ.%20URL:%20https://kopkars.pnj.ac.id/site/login%20Email:%20'.$model->email.'%20Password:%20'.$model->password_default.'%20Mohon%20segera%20reset%20password%20setelah%20Anda%20login%20pertama%20kali.%20Informasi%20lebih%20lanjut%20https://wa.me/62895386952044';},
        ],

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
