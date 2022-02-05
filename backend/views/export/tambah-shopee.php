<?php
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

use common\models\Produk;
use common\models\SettingMarketplace;
use common\models\SettingMarketplaceEtalase;
use common\models\SettingMarketplaceKategori;

$spreadsheet = Yii::getAlias('@app').'/web/public/docs/hiiphooray-tani/template-export-shopee/Shopee_mass_upload_05-02-2022_basic_template.xlsx';

$marketplace = 'shp';

$worksheet_update = 'Template';

$row_mulai = 6;
$column_kategorikode = 'A';
$column_nama = 'B';
$column_deskripsi = 'C';
$column_sku = 'D';
$column_harga = 'L';
$column_stok = 'M';
$column_gambar1 = 'O';
$column_gambar2 = 'P';
$column_gambar3 = 'Q';
$column_gambar4 = 'R';
$column_gambar5 = 'S';
$column_berat = 'X';
//$column_ekspedisi_anteraja = 'AA';
//$column_ekspedisi_shopee_express_standard = 'AB';
//$column_ekspedisi_shopee_express_instant = 'AC';
//$column_ekspedisi_jnt_ekspress = 'AD';
//$column_ekspedisi_jnt_economy = 'AE';
//$column_ekspedisi_ninja_xpress = 'AG';
//$column_ekspedisi_sicepat_reg = 'AH';
//$column_ekspedisi_sicepat_halu = 'AI';
//$column_ekspedisi_jne_reg_cashless = 'AJ';
//$column_ekspedisi_jne_yes_cashless = 'AK';
//$column_ekspedisi_jne_jtr_cashless = 'AL';
//$column_ekspedisi_grabexpress_sameday = 'AM';
//$column_ekspedisi_gosend_sameday = 'AN';
//$column_ekspedisi_grabexpress_instant = 'AO';
//$column_ekspedisi_pos_kilat_khusus = 'AP';
$column_ekspedisi_reguler_cashless = 'AB';
$column_ekspedisi_hemat = 'AC';
$column_ekspedisi_jne_trucking = 'AD';
$column_ekspedisi_sameday = 'AE';
$column_ekspedisi_instant = 'AF';
$column_ekspedisi_nextday = 'AG';
$column_ekspedisi_jnt_jemari = 'AH';

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
        $karakter_asal = array('HiipHooray Youtube Channel');
        $karakter_pengganti = array('Channel HiipHooray');
        $deskripsi = str_replace($karakter_asal,$karakter_pengganti,Produk::deskripsiProduk($marketplace,$model->sku));

        $worksheet->getCell($column_kategorikode.$row_mulai)->setValue(SettingMarketplaceKategori::findOneKategori($marketplace,$model->sku)->kode_variabel_marketplace_kategori);
        $worksheet->getCell($column_nama.$row_mulai)->setValue($model->nama_produk);
        
        $worksheet->getCell($column_deskripsi.$row_mulai)->setValue($deskripsi);
        
        $worksheet->getCell($column_sku.$row_mulai)->setValue($model->sku);
        $worksheet->getCell($column_harga.$row_mulai)->setValue($model->harga_async);
        $worksheet->getCell($column_stok.$row_mulai)->setValue($model->stok_async);
        
        $worksheet->getCell($column_gambar1.$row_mulai)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>1],true));
        $worksheet->getCell($column_gambar2.$row_mulai)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>2],true));
        $worksheet->getCell($column_gambar3.$row_mulai)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>3],true));
        $worksheet->getCell($column_gambar4.$row_mulai)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>4],true));
        $worksheet->getCell($column_gambar5.$row_mulai)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>5],true));

        $worksheet->getCell($column_berat.$row_mulai)->setValue($model->berat);
        //$worksheet->getCell($column_ekspedisi_anteraja.$row_mulai)->setValue(SettingMarketplace::parameter($marketplace)->ekspedisi_anteraja?'Aktif':'Nonaktif');
        //$worksheet->getCell($column_ekspedisi_shopee_express_standard.$row_mulai)->setValue(SettingMarketplace::parameter($marketplace)->ekspedisi_shopee_express_standard?'Aktif':'Nonaktif');
        //$worksheet->getCell($column_ekspedisi_shopee_express_instant.$row_mulai)->setValue(SettingMarketplace::parameter($marketplace)->ekspedisi_shopee_express_instant?'Aktif':'Nonaktif');
        //$worksheet->getCell($column_ekspedisi_jnt_ekspress.$row_mulai)->setValue(SettingMarketplace::parameter($marketplace)->ekspedisi_jnt_ekspress?'Aktif':'Nonaktif');
        //$worksheet->getCell($column_ekspedisi_jnt_economy.$row_mulai)->setValue(SettingMarketplace::parameter($marketplace)->ekspedisi_jnt_economy?'Aktif':'Nonaktif');
        //$worksheet->getCell($column_ekspedisi_jnt_jemari.$row_mulai)->setValue(SettingMarketplace::parameter($marketplace)->ekspedisi_jnt_jemari?'Aktif':'Nonaktif');
        //$worksheet->getCell($column_ekspedisi_ninja_xpress.$row_mulai)->setValue(SettingMarketplace::parameter($marketplace)->ekspedisi_ninja_xpress?'Aktif':'Nonaktif');
        //$worksheet->getCell($column_ekspedisi_sicepat_reg.$row_mulai)->setValue(SettingMarketplace::parameter($marketplace)->ekspedisi_sicepat_reg?'Aktif':'Nonaktif');
        //$worksheet->getCell($column_ekspedisi_sicepat_halu.$row_mulai)->setValue(SettingMarketplace::parameter($marketplace)->ekspedisi_sicepat_halu?'Aktif':'Nonaktif');
        //$worksheet->getCell($column_ekspedisi_jne_reg_cashless.$row_mulai)->setValue(SettingMarketplace::parameter($marketplace)->ekspedisi_jne_reg_cashless?'Aktif':'Nonaktif');
        //$worksheet->getCell($column_ekspedisi_jne_yes_cashless.$row_mulai)->setValue(SettingMarketplace::parameter($marketplace)->ekspedisi_jne_yes_cashless?'Aktif':'Nonaktif');
        //$worksheet->getCell($column_ekspedisi_jne_jtr_cashless.$row_mulai)->setValue(SettingMarketplace::parameter($marketplace)->ekspedisi_jne_jtr_cashless?'Aktif':'Nonaktif');
        //$worksheet->getCell($column_ekspedisi_grabexpress_sameday.$row_mulai)->setValue(SettingMarketplace::parameter($marketplace)->ekspedisi_grabexpress_sameday?'Aktif':'Nonaktif');
        //$worksheet->getCell($column_ekspedisi_gosend_sameday.$row_mulai)->setValue(SettingMarketplace::parameter($marketplace)->ekspedisi_gosend_sameday?'Aktif':'Nonaktif');
        //$worksheet->getCell($column_ekspedisi_grabexpress_instant.$row_mulai)->setValue(SettingMarketplace::parameter($marketplace)->ekspedisi_grabexpress_instant?'Aktif':'Nonaktif');
        //$worksheet->getCell($column_ekspedisi_pos_kilat_khusus.$row_mulai)->setValue(SettingMarketplace::parameter($marketplace)->ekspedisi_pos_kilat_khusus?'Aktif':'Nonaktif');
        $worksheet->getCell($column_ekspedisi_reguler_cashless.$row_mulai)->setValue(SettingMarketplace::parameter($marketplace)->ekspedisi_reguler_cashless?'Aktif':'Nonaktif');
        $worksheet->getCell($column_ekspedisi_hemat.$row_mulai)->setValue(SettingMarketplace::parameter($marketplace)->ekspedisi_hemat?'Aktif':'Nonaktif');
        $worksheet->getCell($column_ekspedisi_kargo.$row_mulai)->setValue(SettingMarketplace::parameter($marketplace)->ekspedisi_kargo?'Aktif':'Nonaktif');
        $worksheet->getCell($column_ekspedisi_sameday.$row_mulai)->setValue(SettingMarketplace::parameter($marketplace)->ekspedisi_sameday?'Aktif':'Nonaktif');
        $worksheet->getCell($column_ekspedisi_instant.$row_mulai)->setValue(SettingMarketplace::parameter($marketplace)->ekspedisi_instant?'Aktif':'Nonaktif');
        $worksheet->getCell($column_ekspedisi_nextday.$row_mulai)->setValue(SettingMarketplace::parameter($marketplace)->ekspedisi_nextday?'Aktif':'Nonaktif');
        $worksheet->getCell($column_ekspedisi_jnt_jemari.$row_mulai)->setValue(SettingMarketplace::parameter($marketplace)->ekspedisi_jnt_jemari?'Aktif':'Nonaktif');

        $row_mulai++;
    }
}

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$namafile = $marketplace.'-tambah-'.date("YmdHis").'.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode($namafile).'"');
$writer->save('php://output');