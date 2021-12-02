<?php
//Saat ini hanya untuk update deskripsi dan video saja

use yii\helpers\Url;
use common\models\Produk;
use common\models\Toko;

$spreadsheet = Yii::getAlias('@app').'/web/public/docs/hiiphooray-tani/template-export-tokopedia/ubah-sekaligus-9146765-(1)-20211202231113.504.xlsx';

$marketplace = 'tkp';

$row_mulai = 4;
$column_deskripsi = 'E';
$column_id = 'B';
$column_gambar1 = 'L';
$column_gambar2 = 'M';
$column_gambar3 = 'N';
$column_gambar4 = 'O';
$column_gambar5 = 'P';
$column_url1 = 'Q';
$column_url2 = 'R';
$column_url3 = 'S';

$column_id_angka = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($column_id);

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');

$spreadsheet = $reader->load($spreadsheet);


$worksheet = $spreadsheet->getActiveSheet();
$highestRow = $worksheet->getHighestRow();
$highestColumn = $worksheet->getHighestColumn();
$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

for ($row = $row_mulai; $row <= $highestRow; ++$row) {
//for ($col = 1; $col <= $highestColumnIndex; ++$col) {
    $id_tkp = $worksheet->getCellByColumnAndRow($column_id_angka, $row)->getValue(); //artinya kolom SKU

    $sku = Produk::findOneProdukByIdTkp($id_tkp)->sku;
    $model = Produk::findOneProduk($sku);

    $deskripsi = Produk::deskripsiProduk($marketplace,$sku);
    $worksheet->getCell($column_deskripsi.$row)->setValue($deskripsi);

    //update gambar disable sementara krn lemot sekali
    //$worksheet->getCell($column_gambar1.$row)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>1],true));
    //$worksheet->getCell($column_gambar2.$row)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>2],true));
    //$worksheet->getCell($column_gambar3.$row)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>3],true));
    //$worksheet->getCell($column_gambar4.$row)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>4],true));
    //$worksheet->getCell($column_gambar5.$row)->setValue(Url::toRoute(['produk/view-foto','kode_toko'=>$model->kode_toko,'sku'=>$model->sku,'ke'=>5],true));

    $worksheet->getCell($column_url1.$row)->setValue($model->video_url_1);
    $worksheet->getCell($column_url2.$row)->setValue($model->video_url_2);
    $worksheet->getCell($column_url3.$row)->setValue($model->video_url_3);
}

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$namafile = $marketplace.'-deskripsi-gambar-video'.date("YmdHis").'.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode($namafile).'"');
$writer->save('php://output');