<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FormFieldSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Form Fields';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-field-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Form Field', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'kode_form',
            'kode_field',
            'nama_field_excel',
            'deskripsi',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
