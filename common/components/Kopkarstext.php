<?php
namespace common\components;

use Yii;
use yii\helpers\Url;
use yii\base\Component;
use yii\helpers\StringHelper;


class Kopkarstext extends Component {
   public function hp62($input)
    {
       return empty($input)?null:'62'.$input;
    }
    public function textOrNull($input)
    {
       return empty($input)?null:$input;
    }
    public function urlFotoProduk($kode_toko,$sku,$ke){
       return Url::to(['@web/backend/produk/view-foto','kode_toko'=>$kode_toko,'sku'=>$sku,'ke'=>$ke],true);
      }

}
