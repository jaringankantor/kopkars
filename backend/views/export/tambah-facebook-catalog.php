<?php
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

use common\models\Produk;
use common\models\SettingMarketplaceEtalase;
use common\models\SettingMarketplaceKategori;

$spreadsheet = Yii::getAlias('@app').'/web/assets/public/docs/hiiphooray-tani/template-export-fbc/CatalogFBP.xlsx';

$marketplace = 'fbc';

$worksheet_update = 'Sheet1';

$row_mulai = 3;
$column_sku = 'A';
$column_nama = 'B';
$column_deskripsi = 'C';
$column_status = 'D';
$column_kondisi = 'E';
$column_harga = 'F';
$column_url_marketplace = 'G';
$column_gambar1 = 'H';
$column_gambar2345 = 'I';
$column_merk = 'J';
$column_stok = 'K';
$column_google_product_category = 'L';
$column_fb_product_category = 'M';
$column_berat = 'X';

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');

$spreadsheet = $reader->load($spreadsheet);

$worksheet = $spreadsheet->getSheetByName($worksheet_update);

$requestPost = Produk::findProduk();

$dataProvider = new ActiveDataProvider([
    'query' => $requestPost->select(['sku','nama_produk','stok_async','harga_async','urlid_tkp']),
    'pagination' => false,
]);

if(count($dataProvider->models)>0) {
    
    foreach ($dataProvider->models as $model) {
        ///Harus diubah sesuai FBP
        $deskripsi = Produk::deskripsiProdukWithAllMarketplaceLink($marketplace,$model->sku);

        $worksheet->getCell($column_sku.$row_mulai)->setValue($model->sku);
        $worksheet->getCell($column_nama.$row_mulai)->setValue($model->nama_produk);
        $worksheet->getCell($column_deskripsi.$row_mulai)->setValue($deskripsi);
        $worksheet->getCell($column_status.$row_mulai)->setValue($model->stok_async>0?'in stock':'out of stock');
        $worksheet->getCell($column_kondisi.$row_mulai)->setValue('new');
        $worksheet->getCell($column_harga.$row_mulai)->setValue($model->harga_async*1.05);
        $worksheet->getCell($column_url_marketplace.$row_mulai)->setValue(!empty($model->urlid_tkp)?$model->urlid_tkp:'https://www.kebunbuah.com/p/contact-us.html');

        $row_mulai++;
    }
}
exit();

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$namafile = $marketplace.'-tambah-'.date("YmdHis").'.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode($namafile).'"');
$writer->save('php://output');