<?php

use kartik\editable\Editable;
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

    <!--

    <p>
        <?= Html::a('Tambah Calon Anggota', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    -->

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
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
                'value'=>function($model, $key, $index)
                {return '+62'.$model->nomor_hp;},
                'editableOptions' => [
                    'formOptions' => [
                        'action' => Url::to(['/anggota/updatehp-editable-json']),
                    ],
                ],
            ],
            [
                'attribute'=>'Informasi Kontak',
                'format'=>'raw',
                'value'=>function($model, $key, $index)
                {return 'Email: '.$model->email.'<br>No HP: +62'.$model->nomor_hp;},
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                    'title' => Yii::t('app', 'lead-view'),
                        ]);
                    },
        
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                    'title' => Yii::t('app', 'lead-update'),
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                    'title' => Yii::t('app', 'lead-delete'),
                        ]);
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
                'visibleButtons' => [
                    'delete' => function ($model, $key, $index) {
                        return empty($model->nomor_anggota) ? true : false;
                    }
                ]
            ],
        ],
        'options'=>['class'=>'box-body table-responsive no-padding'],
    ]); ?>


</div>
