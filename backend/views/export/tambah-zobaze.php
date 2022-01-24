<?php
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

use common\models\Produk;
use common\models\SettingMarketplaceEtalase;
use common\models\SettingMarketplaceKategori;

$spreadsheet = Yii::getAlias('@app').'/web/public/docs/hiiphooray-tani/template-export-zobaze/Zobaze 2.0 Import Excel - Sheet1.xlsx';

$marketplace = 'zbz';

$worksheet_update = 'Sheet1';

$row_mulai = 2;
$column_kategorikode = 'A';
$column_nama = 'B';
$column_sku = 'E';
$column_harga = 'G';
$column_harga_modal = 'H';
$column_stok = 'I';
$column_sku_subitem = 'K';

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');

$spreadsheet = $reader->load($spreadsheet);


$worksheet = $spreadsheet->getSheetByName($worksheet_update);

$requestPost = Produk::findRequestPost(Yii::$app->request->post('sku'));

$dataProvider = new ActiveDataProvider([
    'query' => $requestPost,
    'pagination' => false,
]);

if(count($dataProvider->models)>0) {
    foreach ($dataProvider->models as $model) {
        $worksheet->getCell($column_kategorikode.$row_mulai)->setValue(SettingMarketplaceKategori::findOneKategori($marketplace,$model->sku)->kode_variabel_marketplace_kategori);
        $worksheet->getCell($column_nama.$row_mulai)->setValue($model->nama_produk);
        $worksheet->getCell($column_sku.$row_mulai)->setValue($model->sku);
        $worksheet->getCell($column_harga.$row_mulai)->setValue($model->harga_async);
        $worksheet->getCell($column_harga_modal.$row_mulai)->setValue($model->harga_modal_async);
        $worksheet->getCell($column_stok.$row_mulai)->setValue($model->stok_async);
        $worksheet->getCell($column_sku_subitem.$row_mulai)->setValue($model->sku);

        $row_mulai++;
    }
}

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$namafile = $marketplace.'-tambah-'.date("YmdHis").'.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode($namafile).'"');
$writer->save('php://output');