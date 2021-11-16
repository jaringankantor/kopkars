<?php
//Mulai row 2
//Stok: I
//Harga: J
//SKU: N

use common\models\Produk;
use common\models\SettingMarketplace;
use common\models\Toko;

$spreadsheet = Yii::getAlias('@app').'/web/assets/public/docs/template-export-lazada/pricestock400602186105export1613615640862_0218-10-34-00.xlsx';

$worksheet_update = 'template';
$row_mulai = 2;
$column_stok = 'I';
$column_harga = 'J';
$column_sku = 'N';

$column_sku_angka = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($column_sku);

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');

$spreadsheet = $reader->load($spreadsheet);


$worksheet = $spreadsheet->getSheetByName($worksheet_update);
$highestRow = $worksheet->getHighestRow();
$highestColumn = $worksheet->getHighestColumn();
$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

for ($row = $row_mulai; $row <= $highestRow; ++$row) {
//for ($col = 1; $col <= $highestColumnIndex; ++$col) {
    $sku = $worksheet->getCellByColumnAndRow($column_sku_angka, $row)->getValue(); //artinya kolom SKU
    
    $toko=Toko::findOne(['kode'=>Yii::$app->user->identity->kode_toko]);

    $skuprefix=array();
    foreach ($toko->attributes as $key => $value) {
        if(substr($key,0,9)=='skuprefix'&&!empty($value)){
            array_push($skuprefix,$value);
        }
    }

    if(in_array(substr($sku,0,5),$skuprefix)) {
        $lzd_minimum_price = SettingMarketplace::parameter('lzd')->lzd_minimum_price;

        $model = Produk::findOneProduk($sku);
        $lzd_jumlah_barang_minimum = ceil($lzd_minimum_price/$model->harga_async);
        $stok = floor($model->stok_async/$lzd_jumlah_barang_minimum);
        $harga = $lzd_jumlah_barang_minimum*$model->harga_async;
        
        $worksheet->getCell($column_stok.$row)->setValue($stok);
        $worksheet->getCell($column_harga.$row)->setValue($harga);
    }
}

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$namafile = 'lzd-stokharga-'.date("YmdHis").'.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode($namafile).'"');
$writer->save('php://output');