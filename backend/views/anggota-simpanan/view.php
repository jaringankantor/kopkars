<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AnggotaSimpanan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Anggota Simpanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="anggota-simpanan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'anggota_id',
            'simpanan',
            'rupiah',
            'keterangan',
            'waktu',
            'last_waktu_update',
            'insert_by',
            'last_update_by',
            'is_deleted:boolean',
            'deleted_at',
            'last_softdelete_by',
        ],
    ]) ?>

</div>
