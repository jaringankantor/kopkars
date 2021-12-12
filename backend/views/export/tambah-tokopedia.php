<?php
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

use common\models\Produk;
use common\models\SettingMarketplaceEtalase;
use common\models\SettingMarketplaceKategori;

$spreadsheet = Yii::getAlias('@app').'/web/public/docs/hiiphooray-tani/template-export-tokopedia/tambah-sekaligus(9146765)-20210917.xlsx';

$marketplace = 'tkp';

$worksheet_update = 'ISI Template Impor Produk';

$row_mulai = 4;
$column_nama = 'B';
$column_deskripsi = 'C';
$column_kategorikode = 'D';
$column_berat = 'E';
$column_minimumpemesanan = 'F';
$column_nomoretalase = 'G';
$column_kondisi = 'I';
$column_gambar1 = 'J';
$column_gambar2 = 'K';
$column_gambar3 = 'L';
$column_gambar4 = 'M';
$column_gambar5 = 'N';
$column_url1 = 'O';
$column_url2 = 'P';
$column_url3 = 'Q';
$column_sku = 'R';
$column_status = 'S';
$column_stok = 'T';
$column_harga = 'U';
$column_asuransi = 'V';

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
        $deskripsi = Produk::deskripsiProduk($marketplace,$model->sku);

        $worksheet->getCell($column_nama.$row_mulai)->setValue($model->nama_produk);
        $worksheet->getCell($column_deskripsi.$row_mulai)->setValue($deskripsi);
        $worksheet->getCell($column_kategorikode.$row_mulai)->setValue(SettingMarketplaceKategori::findOneKategori($marketplace,$model->sku)->kode_variabel_marketplace_kategori);
        $worksheet->getCell($column_berat.$row_mulai)->setValue($model->berat);
        $worksheet->getCell($column_minimumpemesanan.$row_mulai)->setValue(1);

        $worksheet->getCell($column_nomoretalase.$row_mulai)->setValue(SettingMarketplaceEtalase::findOneEtalase($marketplace,$model->sku)->kode_variabel_marketplace_etalase);

	    $worksheet->getCell($column_kondisi.$row_mulai)->setValue('Baru');

        $worksheet->getCell($column_gambar1.$row_mulai)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>1],true));
        $worksheet->getCell($column_gambar2.$row_mulai)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>2],true));
        $worksheet->getCell($column_gambar3.$row_mulai)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>3],true));
        $worksheet->getCell($column_gambar4.$row_mulai)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>4],true));
        $worksheet->getCell($column_gambar5.$row_mulai)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>5],true));

        $worksheet->getCell($column_url1.$row_mulai)->setValue($model->video_url_1);
        $worksheet->getCell($column_url2.$row_mulai)->setValue($model->video_url_2);
        $worksheet->getCell($column_url3.$row_mulai)->setValue($model->video_url_3);
        $worksheet->getCell($column_sku.$row_mulai)->setValue($model->sku);
        $worksheet->getCell($column_status.$row_mulai)->setValue($model->stok_async>0?'Aktif':'Nonaktif');
        $worksheet->getCell($column_stok.$row_mulai)->setValue($model->stok_async);
        $worksheet->getCell($column_harga.$row_mulai)->setValue($model->harga_async);

	    $worksheet->getCell($column_asuransi.$row_mulai)->setValue('opsional');

        $row_mulai++;
    }
}

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$namafile = $marketplace.'-tambah-'.date("YmdHis").'.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode($namafile).'"');
$writer->save('php://output');