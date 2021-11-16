<?php
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

use common\models\Produk;
use common\models\SettingMarketplace;
use common\models\SettingMarketplaceKategori;
use common\models\VariabelMarketplaceKategori;

$spreadsheet = Yii::getAlias('@app').'/web/assets/public/docs/hiiphooray-tani/template-export-bukalapak/Template-130221.xlsx';

$marketplace = 'bkl';

$row_mulai = 4;
$column_nama = 'A';
$column_stok = 'B';
$column_berat = 'C';
$column_harga = 'D';
$column_kondisi = 'E';
$column_deskripsi = 'F';
$column_asuransi = 'G';
$column_pengiriman = 'H';
$column_gambar1 = 'I';
$column_gambar2 = 'J';
$column_gambar3 = 'K';
$column_gambar4 = 'L';
$column_gambar5 = 'M';
$column_sku = 'N';

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');

$spreadsheet = $reader->load($spreadsheet);

$marketplaceKategori = VariabelMarketplaceKategori::findMarketplaceKategori($marketplace);

$dataProviderMarketplaceKategori = new ActiveDataProvider([
    'query' => $marketplaceKategori,
    'pagination' => false,
]);

if(count($dataProviderMarketplaceKategori->models)>0) {
    foreach ($dataProviderMarketplaceKategori->models as $marketplaceKategori) {
        $requestPost = SettingMarketplaceKategori::findRequestPostPerKategori($marketplaceKategori->kode_variabel_marketplace,$marketplaceKategori->kode,Yii::$app->request->post('sku'));
        $dataProvider = new ActiveDataProvider([
            'query' => $requestPost,
            'pagination' => false,
        ]);

        if(count($dataProvider->models)>0) {
            $row_awal = $row_mulai;
            $worksheet_update = $marketplaceKategori->kode;
            $worksheet = $spreadsheet->getSheetByName($worksheet_update);
            foreach ($dataProvider->models as $model) {
                $nama_produk = Produk::namaProduk($marketplace,$model->sku);
                
                $deskripsi = Produk::deskripsiProduk($marketplace,$model->sku);

                $worksheet->getCell($column_nama.$row_awal)->setValue($nama_produk);
                
                $worksheet->getCell($column_stok.$row_awal)->setValue($model->stok_async);
                $worksheet->getCell($column_berat.$row_awal)->setValue($model->berat);
                $worksheet->getCell($column_harga.$row_awal)->setValue($model->harga_async);
                $worksheet->getCell($column_kondisi.$row_awal)->setValue('Baru');
                $worksheet->getCell($column_deskripsi.$row_awal)->setValue($deskripsi);
                $worksheet->getCell($column_asuransi.$row_awal)->setValue('Tidak');
                $worksheet->getCell($column_pengiriman.$row_awal)->setValue('pickup | j&tr | sicepatr | sicepatb | grabs | grabi | ninjar | posk | jner | jney | jnet | gosends | gosendi | tikio | tikir');
                
                $worksheet->getCell($column_gambar1.$row_awal)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>1],true));
                $worksheet->getCell($column_gambar2.$row_awal)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>2],true));
                $worksheet->getCell($column_gambar3.$row_awal)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>3],true));
                $worksheet->getCell($column_gambar4.$row_awal)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>4],true));
                $worksheet->getCell($column_gambar5.$row_awal)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>5],true));

                $worksheet->getCell($column_sku.$row_awal)->setValue($model->sku);
            
                $row_awal++;
            }
        } else {
            $worksheet_update = $marketplaceKategori->kode;
            $sheetIndex = $spreadsheet->getIndex($spreadsheet->getSheetByName($worksheet_update));
            $spreadsheet->removeSheetByIndex($sheetIndex);
        }
    }
}

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$namafile = $marketplace.'-tambah-'.date("YmdHis").'.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode($namafile).'"');
$writer->save('php://output');