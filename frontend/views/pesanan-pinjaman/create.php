<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PesananPinjaman */

$this->title = 'Create Pesanan Pinjaman';
$this->params['breadcrumbs'][] = ['label' => 'Pesanan Pinjamen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pesanan-pinjaman-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
