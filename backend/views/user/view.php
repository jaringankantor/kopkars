<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

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
            ['label'=>'Toko','value'=>$model->kodeToko->nama_toko],
            'email:email',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'status',
            //'created_at',
            //'updated_at',
            //'verification_token',
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
