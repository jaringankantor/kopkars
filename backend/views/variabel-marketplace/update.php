<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VariabelMarketplace */

$this->title = 'Update Variabel Marketplace: ' . $model->kode;
$this->params['breadcrumbs'][] = ['label' => 'Variabel Marketplaces', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode, 'url' => ['view', 'id' => $model->kode]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="variabel-marketplace-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
