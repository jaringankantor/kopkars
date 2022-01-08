<?php
namespace api\models;

use common\models\Anggota as CommonAnggota;

class Anggota extends CommonAnggota {

    public function fields()
    {
        return['nama_lengkap',
        //'url_image_1' => function($model){
        //    return $model->sku;
        //}
        ];
    }
}