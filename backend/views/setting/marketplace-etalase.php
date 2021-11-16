<?php
use common\models\VariabelMarketplace;
use common\models\VariabelMarketplaceEtalase;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = VariabelMarketplace::findOneVariabelMarketplace(['kode' => Yii::$app->request->get('marketplace')])->marketplace.' / '.VariabelMarketplaceEtalase::findOneVariabelMarketplaceEtalase(Yii::$app->request->get('marketplace'),Yii::$app->request->get('kode'))->marketplace_etalase;

?>

<div class="col-md-3">
<?
$fulldataarray = VariabelMarketplaceEtalase::findVariabelMarketplaceEtalase()->orderBy(['kode_variabel_marketplace'=>SORT_ASC,'marketplace_etalase'=>SORT_ASC])->all();


foreach ($fulldataarray as $c) {
    $fulldata[] = $c->attributes;
}

$data = array();
if ($fulldata) {
    foreach ($fulldata as $row) {
        $data[$row['kode_variabel_marketplace']][] = $row;
    }
}

$menu = array();
foreach($data as $key => $array_etalase) {
    $data_etalase = array();

    foreach($array_etalase as $etalase) {
        $data_etalase[] = array(
            'label'=>$etalase['marketplace_etalase'],
            'url'=>['setting/marketplace-etalase', 'marketplace' => $key, 'kode' => $etalase['kode']]
        );
    }
    $menu[] = array(
        'label' => VariabelMarketplace::findOneVariabelMarketplace($key)->marketplace,
        'items' => $data_etalase,
    );
}



use kartik\sidenav\SideNav;
echo SideNav::widget([
    'type' => SideNav::TYPE_DEFAULT,
    'heading' => 'Etalase Marketplace',
    'items' => $menu
]);

?>
</div>

<div class="col-md-8">
<h1><?= Html::encode($this->title) ?></h1>

<?= GridView::widget([
    'dataProvider' => $produk_model,
    'columns' => [
        'sku',
        'nama_produk',
        ['class' => 'yii\grid\ActionColumn',
            'template' => '{asign}',
            'buttons' => [
                'asign' => function ($url,$model) {
                    return Html::a('<span class="glyphicon glyphicon-ok"></span> Asign', ['setting/marketplace-etalase-asign','marketplace'=>Yii::$app->request->get('marketplace'),'kode'=>Yii::$app->request->get('kode'),'sku'=>$model->sku], ['class' => 'btn btn-success','data' => ['method' => 'POST']]);
                },
            ],
        ],
    ],
]); ?>

<?= GridView::widget([
    'dataProvider' => $etalase_model,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        ['label'=>'Marketplace', 'value'=>function ($model, $index, $widget) { return $model->kodeVariabelMarketplace->marketplace; }],
        ['label'=>'Etalase', 'value'=>function ($model, $index, $widget) { return $model->kodeVariabelMarketplaceEtalase->marketplace_etalase; }],
        'sku_produk',
        ['label'=>'Nama Produk', 'value'=>function ($model, $index, $widget) { return $model->skuProduk->nama_produk; }],
        ['class' => 'yii\grid\ActionColumn',
            'template' => '{unasign}',
            'buttons' => [
                'unasign' => function ($url,$model) {
                    return Html::a('<span class="glyphicon glyphicon-remove"></span> Un-Asign', ['setting/marketplace-etalase-unasign','marketplace'=>Yii::$app->request->get('marketplace'),'kode'=>Yii::$app->request->get('kode'),'sku'=>$model->sku_produk], ['class' => 'btn btn-danger','data' => ['method' => 'POST']]);
                },
            ],
        ],
    ],
]); ?>
</div>