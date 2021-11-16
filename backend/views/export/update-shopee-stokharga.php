<?php
//Mulai row 4
//Stok: H
//Harga: G
//SKU: E

use common\models\Produk;
use common\models\Toko;

$spreadsheet = Yii::getAlias('@app').'/web/assets/public/docs/template-export-shopee/mass_update_sales_info_hiiphooray_16-02-2021_1613461217325.xlsx';

$row_mulai = 4;
$column_stok = 'H';
$column_harga = 'G';
$column_sku = 'E';

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
        $model = Produk::findOneProduk($sku);
        $worksheet->getCell($column_stok.$row)->setValue($model->stok_async);
        $worksheet->getCell($column_harga.$row)->setValue($model->harga_async);
    }
}

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$namafile = 'shp-stokharga-'.date("YmdHis").'.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode($namafile).'"');
$writer->save('php://output');