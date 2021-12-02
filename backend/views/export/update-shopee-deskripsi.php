<?php

use common\models\Produk;
use common\models\Toko;

$spreadsheet = Yii::getAlias('@app').'/web/public/docs/hiiphooray-tani/template-export-shopee/mass_update_basic_info_hiiphooray_tani_03-12-2021_1638467245644.xlsx';

$marketplace = 'shp';

$row_mulai = 4;
$column_deskripsi = 'D';
$column_sku = 'B';

$column_sku_angka = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($column_sku);

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');

$spreadsheet = $reader->load($spreadsheet);


$worksheet = $spreadsheet->getActiveSheet();
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
        $deskripsi = Produk::deskripsiProduk($marketplace,$sku);
        $worksheet->getCell($column_deskripsi.$row)->setValue($deskripsi);
    }
}

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$namafile = $marketplace.'-deskripsi-'.date("YmdHis").'.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode($namafile).'"');
$writer->save('php://output');