<?php
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

use common\models\Produk;
use common\models\SettingMarketplaceEtalase;
use common\models\SettingMarketplaceKategori;

$spreadsheet = Yii::getAlias('@app').'/web/assets/public/docs/hiiphooray-tani/template-export-jdid/BatchUploadPopProducts1613552058271.xlsx';

$marketplace = 'jdi';

$worksheet_update = 'Sheet1';

$row_mulai = 3;
$column_kategorikode = 'A';
$column_spuid = 'B';
$column_skuid = 'C';
$column_nama = 'D';
$column_nama_sku = 'E';
$column_sale_attribute1 = 'F';
$column_sale_attribute_value1 = 'G';
$column_merk = 'P';
$column_produk_keyword = 'Q';
$column_waranty_period = 'X';
$column_whether_cod = 'Y';
$column_harga = 'Z';
$column_harga_modal = 'AA';
$column_berat = 'AB';
$column_piece_type = 'AC';
$column_dimensi = 'AD';
$column_stok = 'AE';
$column_sku = 'AF';
$column_gambar1 = 'AG';
$column_gambar2345 = 'AH';
$column_deskripsi = 'AI';
$column_deskripsi_hp = 'AJ';
$column_isikotak = 'AK';
$column_aftersale = 'AM';
$column_is_berbahaya = 'AN';

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');

$spreadsheet = $reader->load($spreadsheet);


$worksheet = $spreadsheet->getSheetByName($worksheet_update);

$requestPost = Produk::findRequestPost(Yii::$app->request->post('sku'));

$dataProvider = new ActiveDataProvider([
    'query' => $requestPost,
    'pagination' => false,
]);

if(count($dataProvider->models)>0) {
    $spu_id = 0;
    foreach ($dataProvider->models as $model) {
        $spu_id++;

        $produk_keyword = Produk::keywordProduk($model->sku);

        $deskripsi = Produk::deskripsiProduk($marketplace,$model->sku);

        $berat=$model->berat/1000;
        $isikotak = '1 x '.$model->sku;

        $worksheet->getCell($column_kategorikode.$row_mulai)->setValue(SettingMarketplaceKategori::findOneKategori($marketplace,$model->sku)->kode_variabel_marketplace_kategori);
        $worksheet->getCell($column_spuid.$row_mulai)->setValue($spu_id);
        $worksheet->getCell($column_skuid.$row_mulai)->setValue(1);
        $worksheet->getCell($column_nama.$row_mulai)->setValue($model->nama_produk);
        $worksheet->getCell($column_nama_sku.$row_mulai)->setValue($model->nama_produk);
        $worksheet->getCell($column_sale_attribute1.$row_mulai)->setValue('Color');
        $worksheet->getCell($column_sale_attribute_value1.$row_mulai)->setValue('Multicolor');
        $worksheet->getCell($column_merk.$row_mulai)->setValue('NO BRAND');
        
        $worksheet->getCell($column_produk_keyword.$row_mulai)->setValue($produk_keyword);

        $worksheet->getCell($column_waranty_period.$row_mulai)->setValue('No warranty');
        $worksheet->getCell($column_whether_cod.$row_mulai)->setValue('yes');
        $worksheet->getCell($column_harga.$row_mulai)->setValue($model->harga_async);
        $worksheet->getCell($column_harga_modal.$row_mulai)->setValue($model->harga_async);
        $worksheet->getCell($column_berat.$row_mulai)->setValue($berat);
        $worksheet->getCell($column_piece_type.$row_mulai)->setValue('small piece');
        $worksheet->getCell($column_dimensi.$row_mulai)->setValue('1*1*1');
        $worksheet->getCell($column_stok.$row_mulai)->setValue($model->stok_async);
        $worksheet->getCell($column_sku.$row_mulai)->setValue($model->sku);
        $worksheet->getCell($column_gambar1.$row_mulai)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>1],true));
        $worksheet->getCell($column_gambar2345.$row_mulai)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>2],true).','.Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>3],true).','.Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>4],true).','.Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>5],true));
        $worksheet->getCell($column_deskripsi.$row_mulai)->setValue($deskripsi);
        $worksheet->getCell($column_deskripsi_hp.$row_mulai)->setValue($deskripsi);
        $worksheet->getCell($column_isikotak.$row_mulai)->setValue($isikotak);
        $worksheet->getCell($column_aftersale.$row_mulai)->setValue('Not Support 7 Days Refund and 15 Days Exchange');
        $worksheet->getCell($column_is_berbahaya.$row_mulai)->setValue('No');

        $row_mulai++;
    }
}

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$namafile = $marketplace.'-tambah-'.date("YmdHis").'.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode($namafile).'"');
$writer->save('php://output');