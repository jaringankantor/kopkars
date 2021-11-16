<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FormField */

$this->title = 'Create Form Field';
$this->params['breadcrumbs'][] = ['label' => 'Form Fields', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-field-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
