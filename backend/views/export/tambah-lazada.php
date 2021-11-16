<?php
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

use common\models\Produk;
use common\models\SettingMarketplace;
use common\models\SettingMarketplaceKategori;
use common\models\VariabelMarketplaceKategori;

$spreadsheet = Yii::getAlias('@app').'/web/assets/public/docs/hiiphooray-tani/template-export-lazada/newPublish400602186105export1613147575173_0213-00-32-55.xlsx';

$marketplace = 'lzd';

///Belum selesai mendata semua kolom
$row_mulai = 3;
$column_nama = 'C';
$column_gambar1 = 'D';
$column_gambar2 = 'E';
$column_gambar3 = 'F';
$column_gambar4 = 'G';
$column_gambar5 = 'H';

$column_url1=array();
$column_url1['MakananIkan'] = 'P';
$column_url1['PeralatanKebun'] = 'P';
$column_url1['TanahPupukMulsa'] = 'P';
$column_url1['SistemPengairan'] = 'P';
$column_url1['Hiasandekorasitaman'] = 'P';
$column_url1['PotPotBesarGuciTaman'] = 'P';
$column_url1['TanamanBijidanUmbi'] = 'P';
$column_url1['PembasmiRumputLiarHama'] = 'P';
$column_url1['Label'] = 'O';

$column_merk=array();
$column_merk['MakananIkan'] = 'Q';
$column_merk['PeralatanKebun'] = 'Q';
$column_merk['TanahPupukMulsa'] = 'Q';
$column_merk['SistemPengairan'] = 'Q';
$column_merk['Hiasandekorasitaman'] = 'Q';
$column_merk['PotPotBesarGuciTaman'] = 'Q';
$column_merk['TanamanBijidanUmbi'] = 'Q';
$column_merk['PembasmiRumputLiarHama'] = 'Q';
$column_merk['Label'] = 'P';

$column_deskripsi=array();
$column_deskripsi['MakananIkan'] = 'U';
$column_deskripsi['PeralatanKebun'] = 'U';
$column_deskripsi['TanahPupukMulsa'] = 'T';
$column_deskripsi['SistemPengairan'] = 'T';
$column_deskripsi['Hiasandekorasitaman'] = 'S';
$column_deskripsi['PotPotBesarGuciTaman'] = 'U';
$column_deskripsi['TanamanBijidanUmbi'] = 'S';
$column_deskripsi['PembasmiRumputLiarHama'] = 'T';
$column_deskripsi['Label'] = 'V';

$column_isikotak=array();
$column_isikotak['MakananIkan'] = 'W';
$column_isikotak['PeralatanKebun'] = 'W';
$column_isikotak['TanahPupukMulsa'] = 'V';
$column_isikotak['SistemPengairan'] = 'V';
$column_isikotak['Hiasandekorasitaman'] = 'U';
$column_isikotak['PotPotBesarGuciTaman'] = 'W';
$column_isikotak['TanamanBijidanUmbi'] = 'U';
$column_isikotak['PembasmiRumputLiarHama'] = 'V';
$column_isikotak['Label'] = 'X';

$column_berat=array();
$column_berat['MakananIkan'] = 'AA';
$column_berat['PeralatanKebun'] = 'AA';
$column_berat['TanahPupukMulsa'] = 'Z';
$column_berat['SistemPengairan'] = 'Z';
$column_berat['Hiasandekorasitaman'] = 'Y';
$column_berat['PotPotBesarGuciTaman'] = 'AA';
$column_berat['TanamanBijidanUmbi'] = 'Y';
$column_berat['PembasmiRumputLiarHama'] = 'Z';
$column_berat['Label'] = 'AB';

$column_panjang=array();
$column_panjang['MakananIkan'] = 'AB';
$column_panjang['PeralatanKebun'] = 'AB';
$column_panjang['TanahPupukMulsa'] = 'AA';
$column_panjang['SistemPengairan'] = 'AA';
$column_panjang['Hiasandekorasitaman'] = 'Z';
$column_panjang['PotPotBesarGuciTaman'] = 'AB';
$column_panjang['TanamanBijidanUmbi'] = 'Z';
$column_panjang['PembasmiRumputLiarHama'] = 'AA';
$column_panjang['Label'] = 'AC';

$column_lebar=array();
$column_lebar['MakananIkan'] = 'AC';
$column_lebar['PeralatanKebun'] = 'AC';
$column_lebar['TanahPupukMulsa'] = 'AB';
$column_lebar['SistemPengairan'] = 'AA';
$column_lebar['Hiasandekorasitaman'] = 'AA';
$column_lebar['PotPotBesarGuciTaman'] = 'AC';
$column_lebar['TanamanBijidanUmbi'] = 'AA';
$column_lebar['PembasmiRumputLiarHama'] = 'AB';
$column_lebar['Label'] = 'AD';

$column_tinggi=array();
$column_tinggi['MakananIkan'] = 'AD';
$column_tinggi['PeralatanKebun'] = 'AD';
$column_tinggi['TanahPupukMulsa'] = 'AC';
$column_tinggi['SistemPengairan'] = 'AC';
$column_tinggi['Hiasandekorasitaman'] = 'AB';
$column_tinggi['PotPotBesarGuciTaman'] = 'AD';
$column_tinggi['TanamanBijidanUmbi'] = 'AB';
$column_tinggi['PembasmiRumputLiarHama'] = 'AC';
$column_tinggi['Label'] = 'AE';

$column_stok=array();
$column_stok['MakananIkan'] = 'AP';
$column_stok['PeralatanKebun'] = 'AR';
$column_stok['TanahPupukMulsa'] = 'AR';
$column_stok['SistemPengairan'] = 'AQ';
$column_stok['Hiasandekorasitaman'] = 'AP';
$column_stok['PotPotBesarGuciTaman'] = 'AR';
$column_stok['TanamanBijidanUmbi'] = 'AP';
$column_stok['PembasmiRumputLiarHama'] = 'AQ';
$column_stok['Label'] = 'AU';

$column_harga=array();
$column_harga['MakananIkan'] = 'AQ';
$column_harga['PeralatanKebun'] = 'AS';
$column_harga['TanahPupukMulsa'] = 'AS';
$column_harga['SistemPengairan'] = 'AR';
$column_harga['Hiasandekorasitaman'] = 'AQ';
$column_harga['PotPotBesarGuciTaman'] = 'AS';
$column_harga['TanamanBijidanUmbi'] = 'AQ';
$column_harga['PembasmiRumputLiarHama'] = 'AR';
$column_harga['Label'] = 'AV';

$column_sku=array();
$column_sku['MakananIkan'] = 'AU';
$column_sku['PeralatanKebun'] = 'AW';
$column_sku['TanahPupukMulsa'] = 'AW';
$column_sku['SistemPengairan'] = 'AV';
$column_sku['Hiasandekorasitaman'] = 'AU';
$column_sku['PotPotBesarGuciTaman'] = 'AW';
$column_sku['TanamanBijidanUmbi'] = 'AU';
$column_sku['PembasmiRumputLiarHama'] = 'AV';
$column_sku['Label'] = 'AZ';

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');

$spreadsheet = $reader->load($spreadsheet);

$marketplaceKategori = VariabelMarketplaceKategori::findMarketplaceKategori('lzd');

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
                $lzd_minimum_price = SettingMarketplace::parameter($marketplace)->lzd_minimum_price;

                $lzd_jumlah_barang_minimum = ceil($lzd_minimum_price/$model->harga_async);
                $nama_produk = $lzd_jumlah_barang_minimum>1 ? $model->nama_produk.' ('.$lzd_jumlah_barang_minimum.' barang)' : $model->nama_produk;
                $deskripsi = $lzd_jumlah_barang_minimum>1 ? $nama_produk."\n\n".Produk::deskripsiProduk($marketplace,$model->sku) : Produk::deskripsiProduk($marketplace,$model->sku);
                $isikotak = $lzd_jumlah_barang_minimum.' x '.$model->sku;
                $stok = floor($model->stok_async/$lzd_jumlah_barang_minimum);
                $harga = $lzd_jumlah_barang_minimum*$model->harga_async;
                $berat = $lzd_jumlah_barang_minimum*$model->berat/1000;

                
                $worksheet->getCell($column_nama.$row_awal)->setValue($nama_produk);
                
                $worksheet->getCell($column_gambar1.$row_awal)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>1],true));
                $worksheet->getCell($column_gambar2.$row_awal)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>2],true));
                $worksheet->getCell($column_gambar3.$row_awal)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>3],true));
                $worksheet->getCell($column_gambar4.$row_awal)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>4],true));
                $worksheet->getCell($column_gambar5.$row_awal)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>5],true));

                $worksheet->getCell($column_url1[$marketplaceKategori->kode].$row_awal)->setValue($model->video_url_1);

                $worksheet->getCell($column_merk[$marketplaceKategori->kode].$row_awal)->setValue('All merk');

                $worksheet->getCell($column_deskripsi[$marketplaceKategori->kode].$row_awal)->setValue($deskripsi);

                $worksheet->getCell($column_isikotak[$marketplaceKategori->kode].$row_awal)->setValue($isikotak);

                $worksheet->getCell($column_berat[$marketplaceKategori->kode].$row_awal)->setValue($berat);

                $worksheet->getCell($column_panjang[$marketplaceKategori->kode].$row_awal)->setValue(1);

                $worksheet->getCell($column_lebar[$marketplaceKategori->kode].$row_awal)->setValue(1);

                $worksheet->getCell($column_tinggi[$marketplaceKategori->kode].$row_awal)->setValue(1);

                $worksheet->getCell($column_stok[$marketplaceKategori->kode].$row_awal)->setValue($stok);

                $worksheet->getCell($column_harga[$marketplaceKategori->kode].$row_awal)->setValue($harga);

                $worksheet->getCell($column_sku[$marketplaceKategori->kode].$row_awal)->setValue($model->sku);
            
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