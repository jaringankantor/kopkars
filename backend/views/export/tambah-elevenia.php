<?php
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\helpers\Url;

use common\models\Produk;
use common\models\SettingMarketplace;
use common\models\SettingMarketplaceKategori;

$spreadsheet = Yii::getAlias('@app').'/web/assets/public/docs/hiiphooray-tani/template-export-elevenia/bulk-upload-Ver1.2in.xls';

$marketplace = 'elv';

$worksheet_update = 'Bulk Upload Template';

$row_mulai = 3;
$column_kategorikode = 'B';
$column_nama = 'C';
$column_is_under17age = 'D';
$column_gambar1 = 'E';
$column_gambar2 = 'F';
$column_gambar3 = 'G';
$column_gambar4 = 'H';
$column_deskripsi = 'I';
$column_harga = 'J';
$column_berat = 'L';
$column_stok = 'M';
$column_delivery_template_number = 'N';
$column_return_information = 'O';
$column_sku = 'P';


$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');

$spreadsheet = $reader->load($spreadsheet);

$worksheet = $spreadsheet->getSheetByName($worksheet_update);

$requestPost = Produk::findRequestPost(Yii::$app->request->post('sku'));

$dataProvider = new ActiveDataProvider([
    'query' => $requestPost,
    'pagination' => false,
]);

if(count($dataProvider->models)>0) {
    foreach ($dataProvider->models as $model) {
        $deskripsi = Produk::deskripsiProduk($marketplace,$model->sku);

        $berat = $model->berat/1000;

        $worksheet->getCell($column_kategorikode.$row_mulai)->setValue(SettingMarketplaceKategori::findOneKategori($marketplace,$model->sku)->kode_variabel_marketplace_kategori);
        $worksheet->getCell($column_nama.$row_mulai)->setValue($model->nama_produk);
        $worksheet->getCell($column_is_under17age.$row_mulai)->setValue('Y');
        $worksheet->getCell($column_gambar1.$row_mulai)->setValue($model->sku.' (1).jpg');
        $worksheet->getCell($column_gambar2.$row_mulai)->setValue($model->sku.' (2).jpg');
        $worksheet->getCell($column_gambar3.$row_mulai)->setValue($model->sku.' (3).jpg');
        $worksheet->getCell($column_gambar4.$row_mulai)->setValue($model->sku.' (4).jpg');
        $worksheet->getCell($column_deskripsi.$row_mulai)->setValue($deskripsi);
        $worksheet->getCell($column_harga.$row_mulai)->setValue($model->harga_async);
        $worksheet->getCell($column_berat.$row_mulai)->setValue($berat);
        $worksheet->getCell($column_stok.$row_mulai)->setValue($model->stok_async);
        $worksheet->getCell($column_delivery_template_number.$row_mulai)->setValue('547324');
        $worksheet->getCell($column_return_information.$row_mulai)->setValue('Info lebih lanjut di web seller elevenia');
        $worksheet->getCell($column_sku.$row_mulai)->setValue($model->sku);

        $row_mulai++;
    }
}

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
$namafile = $marketplace.'-tambah-'.date("YmdHis").'.xls';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode($namafile).'"');
$writer->save('php://output');