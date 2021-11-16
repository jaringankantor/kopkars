<div class="col-md-3">
<?php
use common\models\VariabelMarketplace;
use common\models\VariabelMarketplaceKategori;
use yii\grid\GridView;
use yii\helpers\Html;

$fulldataarray = VariabelMarketplaceKategori::findVariabelMarketplaceKategori()->orderBy(['kode_variabel_marketplace'=>SORT_ASC,'marketplace_kategori'=>SORT_ASC])->all();


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
foreach($data as $key => $array_kategori) {
    $data_kategori = array();

    foreach($array_kategori as $kategori) {
        $data_kategori[] = array(
            'label'=>$kategori['marketplace_kategori'],
            'url'=>['setting/marketplace-kategori', 'marketplace' => $key, 'kode' => $kategori['kode']]
        );
    }
    $menu[] = array(
        'label' => VariabelMarketplace::findOneVariabelMarketplace($key)->marketplace,
        'items' => $data_kategori,
    );
}



use kartik\sidenav\SideNav;
echo SideNav::widget([
    'type' => SideNav::TYPE_DEFAULT,
    'heading' => 'Kategori Marketplace',
    'items' => $menu
]);

$this->title = VariabelMarketplace::findOneVariabelMarketplace(Yii::$app->request->get('marketplace'))->marketplace.' / '.VariabelMarketplaceKategori::findOneVariabelMarketplaceKategori(Yii::$app->request->get('marketplace'),Yii::$app->request->get('kode'))->marketplace_kategori;

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
                    return Html::a('<span class="glyphicon glyphicon-ok"></span> Asign', ['setting/marketplace-kategori-asign','marketplace'=>Yii::$app->request->get('marketplace'),'kode'=>Yii::$app->request->get('kode'),'sku'=>$model->sku], ['class' => 'btn btn-success','data' => ['method' => 'POST']]);
                },
            ],
        ],
    ],
]); ?>

<?= GridView::widget([
    'dataProvider' => $kategori_model,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        ['label'=>'Marketplace', 'value'=>function ($model, $index, $widget) { return $model->kodeVariabelMarketplace->marketplace; }],
        ['label'=>'Kategori', 'value'=>function ($model, $index, $widget) { return $model->kodeVariabelMarketplaceKategori->marketplace_kategori; }],
        'sku_produk',
        ['label'=>'Nama Produk', 'value'=>function ($model, $index, $widget) { return $model->skuProduk->nama_produk; }],
        ['class' => 'yii\grid\ActionColumn',
            'template' => '{unasign}',
            'buttons' => [
                'unasign' => function ($url,$model) {
                    return Html::a('<span class="glyphicon glyphicon-remove"></span> Un-Asign', ['setting/marketplace-kategori-unasign','marketplace'=>Yii::$app->request->get('marketplace'),'kode'=>Yii::$app->request->get('kode'),'sku'=>$model->sku_produk], ['class' => 'btn btn-danger','data' => ['method' => 'POST']]);
                },
            ],
        ],
    ],
]); ?>
</div>