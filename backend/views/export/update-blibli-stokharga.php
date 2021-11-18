<?php
//Mulai row 2
//Stok: G
//Harga: F
//Dapat Dibeli: J
//SKU: D

use common\models\Produk;
use common\models\Toko;

$spreadsheet = Yii::getAlias('@app').'/web/public/docs/template-export-blibli/bulk-update-product-template.xlsx';

$worksheet_update = 'Data';
$row_mulai = 2;
$column_stok = 'G';
$column_harga_normal = 'E';
$column_harga_penjualan = 'F';
$column_dapatdibeli = 'J';
$column_sku = 'D';

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
        $model = Produk::findOneProduk($sku);
        $worksheet->getCell($column_dapatdibeli.$row)->setValue($model->stok_async>0?1:0);
        $worksheet->getCell($column_stok.$row)->setValue($model->stok_async);
        $worksheet->getCell($column_harga_normal.$row)->setValue($model->harga_async);
        $worksheet->getCell($column_harga_penjualan.$row)->setValue($model->harga_async);
    }
}

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$namafile = 'bli-stokharga-'.date("YmdHis").'.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode($namafile).'"');
$writer->save('php://output');