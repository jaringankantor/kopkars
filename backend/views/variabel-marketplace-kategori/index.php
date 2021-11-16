<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\VariabelMarketplaceKategoriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Variabel Marketplace Kategoris';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="variabel-marketplace-kategori-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Variabel Marketplace Kategori', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'kode_variabel_marketplace',
            'kode',
            'marketplace_kategori',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
