<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VariabelMarketplaceKategori */

$this->title = 'Update Variabel Marketplace Kategori: ' . $model->kode_variabel_marketplace;
$this->params['breadcrumbs'][] = ['label' => 'Variabel Marketplace Kategoris', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_variabel_marketplace, 'url' => ['view', 'kode_variabel_marketplace' => $model->kode_variabel_marketplace, 'kode' => $model->kode]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="variabel-marketplace-kategori-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
