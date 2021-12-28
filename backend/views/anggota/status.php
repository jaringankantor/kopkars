<?php

use kartik\editable\Editable;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AnggotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Status Anggota';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anggota-status">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nomor_anggota',
            'nomor_pegawai',
            'nama_lengkap',
            'status',
        ],
        'options'=>['class'=>'box-body table-responsive no-padding'],
    ]); ?>


</div>
