<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TokoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tokos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="toko-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Toko', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'kode',
            'nama_toko',
            //'skuprefix1',
            //'skuprefix2',
            //'skuprefix3',
            //'skuprefix4',
            //'skuprefix5',
            //'skuprefix6',
            //'skuprefix7',
            //'skuprefix8',
            //'skuprefix9',
            //'skuprefix10',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
