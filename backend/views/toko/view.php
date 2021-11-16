<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Toko */

$this->title = $model->kode;
$this->params['breadcrumbs'][] = ['label' => 'Tokos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="toko-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->kode], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->kode], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kode',
            'nama_toko',
            'skuprefix1',
            'skuprefix2',
            'skuprefix3',
            'skuprefix4',
            'skuprefix5',
            'skuprefix6',
            'skuprefix7',
            'skuprefix8',
            'skuprefix9',
            'skuprefix10',
        ],
    ]) ?>

</div>
