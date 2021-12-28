<?php
use common\models\HistoriAnggota;
use common\models\VariabelStatus;
use kartik\editable\Editable;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AnggotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Histori Anggota';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anggota-status">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search_histori', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nomor_anggota',
            'nomor_pegawai',
            'nama_lengkap',
            [
                'attribute'=>'Histori',
                'format'=>'raw',
                'value'=>function($model, $key, $index)
                {
                    $query = HistoriAnggota::find()->where(['anggota_id'=>$model->id])->all();
                    $historianggota = NULL;
                    foreach ($query as $row) {
                        $historianggota .= $row['anggota_kolom'].': '.$row['value_old'].' => '.$row['value_new'].' ('.$row['waktu_update'].')<br>';
                    
                    }

                    return $historianggota;
                },
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'status',
                'editableOptions' => [
                    'formOptions' => [
                        'action' => Url::to(['/anggota/updatestatus-editable-json']),
                    ],
                    'inputType' => Editable::INPUT_DROPDOWN_LIST,
                    'data' => ArrayHelper::map(VariabelStatus::find()->all(),'status','status'),
                ],
            ],
        ],
        'options'=>['class'=>'box-body table-responsive no-padding'],
    ]); ?>


</div>
