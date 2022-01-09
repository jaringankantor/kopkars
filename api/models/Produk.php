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
        'sku','nama_produk','deskripsi',
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
        return ['deskripsi',
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
        }];
    }

    public static function findProdukAktifByKodeToko($kode_toko)
    {
        return self::find()
        ->andWhere(['status_aktif'=>TRUE])
        ->andWhere(['kode_toko'=>$kode_toko]);
    }

    public static function findOneProdukAktifByKodeToko($kode_toko,$sku)
    {
        return self::findProdukAktifByKodeToko($kode_toko)
            ->andWhere(['sku'=>$sku])
            ->one();
    }
}