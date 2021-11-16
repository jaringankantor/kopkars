<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Toko */

$this->title = 'Create Toko';
$this->params['breadcrumbs'][] = ['label' => 'Tokos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="toko-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
