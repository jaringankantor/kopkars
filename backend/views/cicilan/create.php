<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Cicilan */

$this->title = 'Create Cicilan';
$this->params['breadcrumbs'][] = ['label' => 'Cicilans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cicilan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
