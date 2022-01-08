<?php
namespace api\models;

use Yii;
use common\models\Produk as CommonProduk;

class Produk extends CommonProduk {

    public function fields()
    {
        return[
        'kode_toko' => function($model){
            return $model->kode_toko;
        },
        'sku','nama_produk',
        'url_image_1' => function($model){
            return Yii::$app->kopkarstext->urlFotoProdukBackend($model->kode_toko,$model->sku,1);
        },
        'url_image_2' => function($model){
            return Yii::$app->kopkarstext->urlFotoProdukBackend($model->kode_toko,$model->sku,2);
        },
        'url_image_3' => function($model){
            return Yii::$app->kopkarstext->urlFotoProdukBackend($model->kode_toko,$model->sku,3);
        },
        'url_image_4' => function($model){
            return Yii::$app->kopkarstext->urlFotoProdukBackend($model->kode_toko,$model->sku,4);
        },
        'url_image_5' => function($model){
            return Yii::$app->kopkarstext->urlFotoProdukBackend($model->kode_toko,$model->sku,5);
        }
        ];
    }

    public function extraFields()
    {
        return ['deskripsi'];
    }
}