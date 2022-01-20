<?php

use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\helpers\Url;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CicilanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cicilan Anggota';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cicilan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <p>
        <?= Html::a('Create Cicilan', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['label'=>'Nama Anggota Kopkars', 'value'=>function ($model, $index, $widget) { return $model->anggota->nama_lengkap; }],
            'kanal_cicilan',
            'nomor_referensi',
            'cicilan:currency',
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'keterangan',
                'value'=>function($model, $key, $index){
                    return $model->keterangan;
                },
                'editableOptions' => [
                    'formOptions' => [
                        'action' => Url::to(['/cicilan/update-keterangan-editable-json']),
                    ],
                ],
            ],
            'waktu:date',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
