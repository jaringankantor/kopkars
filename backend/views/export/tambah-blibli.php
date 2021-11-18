<?php
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\helpers\Url;

use common\models\Produk;
use common\models\SettingMarketplace;

$spreadsheet = Yii::getAlias('@app').'/web/public/docs/hiiphooray-tani/template-export-blibli/Perlengkapan_Taman_Lainnya_template.xlsx';

$marketplace = 'bli';

$worksheet_update = 'Data';

$row_mulai = 5;
$column_nama = 'A';
$column_sku = 'C';
$column_deskripsi = 'D';
$column_buyable = 'F';
$column_merk = 'G';
$column_gambar1 = 'K';
$column_gambar2 = 'L';
$column_gambar3 = 'M';
$column_gambar4 = 'N';
$column_gambar5 = 'O';
$column_url1 = 'S';
$column_tipepenanganan = 'T';
$column_kodetoko = 'U';
$column_panjang = 'V';
$column_lebar = 'W';
$column_tinggi = 'X';
$column_berat = 'Y';
$column_harga = 'Z';
$column_hargapenjualan = 'AA';
$column_stok = 'AB';
$column_stokminimum = 'AC';

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
        $kodetoko = SettingMarketplace::parameter($marketplace)->bli_kodetokogudang;
        
        $deskripsi = Produk::deskripsiProduk($marketplace,$model->sku);

        $worksheet->getCell($column_nama.$row_mulai)->setValue($model->nama_produk);
        $worksheet->getCell($column_sku.$row_mulai)->setValue($model->sku);
        $worksheet->getCell($column_deskripsi.$row_mulai)->setValue($deskripsi);
        $worksheet->getCell($column_buyable.$row_mulai)->setValue('SKU bisa dibeli di website');
        $worksheet->getCell($column_merk.$row_mulai)->setValue($model->brand);
        
        //$worksheet->getCell($column_gambar1.$row_mulai)->setValue($model->sku.' (1).jpg');
        //$worksheet->getCell($column_gambar2.$row_mulai)->setValue($model->sku.' (2).jpg');
        //$worksheet->getCell($column_gambar3.$row_mulai)->setValue($model->sku.' (3).jpg');
        //$worksheet->getCell($column_gambar4.$row_mulai)->setValue($model->sku.' (4).jpg');
        //$worksheet->getCell($column_gambar5.$row_mulai)->setValue($model->sku.' (5).jpg');

        $worksheet->getCell($column_gambar1.$row_mulai)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>1],true));
        $worksheet->getCell($column_gambar2.$row_mulai)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>2],true));
        $worksheet->getCell($column_gambar3.$row_mulai)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>3],true));
        $worksheet->getCell($column_gambar4.$row_mulai)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>4],true));
        $worksheet->getCell($column_gambar5.$row_mulai)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>5],true));

        $worksheet->getCell($column_url1.$row_mulai)->setValue($model->video_url_1);
        
        $worksheet->getCell($column_tipepenanganan.$row_mulai)->setValue('Melalui partner logistik Blibli');
        
        $worksheet->getCell($column_kodetoko.$row_mulai)->setValue($kodetoko);
        
        $worksheet->getCell($column_panjang.$row_mulai)->setValue(1);
        $worksheet->getCell($column_lebar.$row_mulai)->setValue(1);
        $worksheet->getCell($column_tinggi.$row_mulai)->setValue(1);

        $worksheet->getCell($column_berat.$row_mulai)->setValue($model->berat);
        $worksheet->getCell($column_harga.$row_mulai)->setValue($model->harga_async);
        $worksheet->getCell($column_hargapenjualan.$row_mulai)->setValue($model->harga_async);
        $worksheet->getCell($column_stok.$row_mulai)->setValue($model->stok_async);
        $worksheet->getCell($column_stokminimum.$row_mulai)->setValue(5);

        $row_mulai++;
    }
}

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$namafile = $marketplace.'-tambah-'.date("YmdHis").'.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode($namafile).'"');
$writer->save('php://output');