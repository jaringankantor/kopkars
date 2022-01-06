<?php
namespace frontend\models;

use Yii;
use common\models\Produk;

class ApiProduk extends Produk {
    public function fields()
    {
        return['sku','nama_produk',
        //'url_image_1' => function($model){
        //    return $model->sku;
        //}
        ];
    }
}