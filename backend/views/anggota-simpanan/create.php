<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AnggotaSimpanan */

$this->title = 'Create Anggota Simpanan';
$this->params['breadcrumbs'][] = ['label' => 'Anggota Simpanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anggota-simpanan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
