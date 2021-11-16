<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VariabelMarketplaceEtalase */

$this->title = 'Update Variabel Marketplace Etalase: ' . $model->kode_variabel_marketplace;
$this->params['breadcrumbs'][] = ['label' => 'Variabel Marketplace Etalases', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_variabel_marketplace, 'url' => ['view', 'kode_variabel_marketplace' => $model->kode_variabel_marketplace, 'kode' => $model->kode]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="variabel-marketplace-etalase-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
