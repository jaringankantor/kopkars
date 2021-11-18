<?php
//Mulai row 2
//Stok: I
//Harga: J
//SKU: N

use common\models\Produk;
use common\models\SettingMarketplace;
use common\models\Toko;

$spreadsheet = Yii::getAlias('@app').'/web/public/docs/hiiphooray-tani/template-export-lazada/basic400602186105export1630734241103_0904-13-44-01.xlsx';

$worksheet_update = 'template';

$marketplace = 'lzd';

$row_mulai = 2;
$column_id = 'A';
$column_longdeskripsi = 'R';

$column_id_angka = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($column_id);

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');

$spreadsheet = $reader->load($spreadsheet);


$worksheet = $spreadsheet->getSheetByName($worksheet_update);
$highestRow = $worksheet->getHighestRow();
$highestColumn = $worksheet->getHighestColumn();
$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

for ($row = $row_mulai; $row <= $highestRow; ++$row) {
//for ($col = 1; $col <= $highestColumnIndex; ++$col) {
    $id_lzd = $worksheet->getCellByColumnAndRow($column_id_angka, $row)->getValue(); //artinya kolom PRODUCT ID

    $sku = Produk::findOneProdukByIdLzd($id_lzd)->sku;
            
    $longdeskripsi = Produk::deskripsiProduk($marketplace,$sku);
    $worksheet->getCell($column_longdeskripsi.$row)->setValue($longdeskripsi);
}

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$namafile = 'lzd-deskripsi-'.date("YmdHis").'.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode($namafile).'"');
$writer->save('php://output');