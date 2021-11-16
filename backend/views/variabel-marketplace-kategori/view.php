<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\VariabelMarketplaceKategori */

$this->title = $model->kode_variabel_marketplace;
$this->params['breadcrumbs'][] = ['label' => 'Variabel Marketplace Kategoris', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="variabel-marketplace-kategori-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'kode_variabel_marketplace' => $model->kode_variabel_marketplace, 'kode' => $model->kode], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'kode_variabel_marketplace' => $model->kode_variabel_marketplace, 'kode' => $model->kode], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kode_variabel_marketplace',
            'kode',
            'marketplace_kategori',
        ],
    ]) ?>

</div>
