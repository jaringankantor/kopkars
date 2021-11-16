<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VariabelMarketplaceKategori */

$this->title = 'Create Variabel Marketplace Kategori';
$this->params['breadcrumbs'][] = ['label' => 'Variabel Marketplace Kategoris', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="variabel-marketplace-kategori-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
