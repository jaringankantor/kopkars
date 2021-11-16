<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VariabelMarketplaceEtalase */

$this->title = 'Create Variabel Marketplace Etalase';
$this->params['breadcrumbs'][] = ['label' => 'Variabel Marketplace Etalases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="variabel-marketplace-etalase-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
