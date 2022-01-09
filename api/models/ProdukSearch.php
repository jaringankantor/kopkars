<?php
namespace api\models;

//use yii\base\Model;
use common\models\ProdukSearch as CommonProdukSearch;

class ProdukSearch extends CommonProdukSearch
{
    public $sku;
    public $nama_produk;
    
    public function rules()
    {
        return [
            ['sku', 'string', 'min' => 6],
            ['nama_produk', 'string', 'min' => 4],              
        ];
    }
}