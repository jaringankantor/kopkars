<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Anggota */

$this->title = 'Formulir Pendaftaran KOPKARS PNJ';
//$this->params['breadcrumbs'][] = ['label' => 'Anggotas', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anggota-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_registrasi', [
        'model' => $model,
    ]) ?>

</div>
