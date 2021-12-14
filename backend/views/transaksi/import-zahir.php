<?php
use common\models\Anggota;
use common\models\Transaksi;
use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\UploadedFile;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;

$worksheet_update = 'Page1';

$row_mulai = 6;
$column_tanggal = 'A';
$column_reference = 'B';
$column_nopesanan = 'C';
$column_pelanggan = 'G';
$column_matauang = 'K';
$column_subtotal = 'L';
$column_diskon = 'N';
$column_pajak = 'P';
$column_totalpenjualan = 'Q';
$column_pembayaran = 'T';
$column_saldo= 'V';

$this->title = 'Import Transaksi Zahir';
//$this->params['breadcrumbs'][] = $this->title;

?>

<div class="transaksi-import-zahir">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Lakukan export data dari aplikasi Zahir, dengan cara: </p>
    <?php

    if (Yii::$app->request->isPost) {
                
        $upload->attachmentFile = UploadedFile::getInstance($upload, 'attachmentFile');
        if ($upload->attachmentFile && $upload->validate()) {
            $extension = $upload->attachmentFile->extension;
            if($extension=='xlsx'){
                $inputFileType = 'Xlsx';
            }else{
                $inputFileType = 'Xls';
            }
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);

            $spreadsheet = $reader->load($upload->attachmentFile->tempName);
            $worksheet = $spreadsheet->getSheetByName($worksheet_update);
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

            $sum_error = 0;
            //inilah looping untuk membaca cell dalam file excel,perkolom
            for ($row = $row_mulai; $row <= $highestRow; ++$row) { //$row = 2 artinya baris kedua yang dibaca dulu(header kolom diskip disesuaikan saja)
                //for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                $tanggal = trim($worksheet->getCell($column_tanggal.$row)->getValue());
                $reference = trim($worksheet->getCell($column_reference.$row)->getValue());
                $nopesanan_get = trim($worksheet->getCell($column_nopesanan.$row)->getValue());
                $nopesanan = empty($nopesanan_get)?NULL:$nopesanan_get;
                $pelanggan = trim($worksheet->getCell($column_pelanggan.$row)->getValue());
                $matauang = trim($worksheet->getCell($column_matauang.$row)->getValue());
                $subtotal = trim($worksheet->getCell($column_subtotal.$row)->getValue());
                $diskon = trim($worksheet->getCell($column_diskon.$row)->getValue());
                $pajak = trim($worksheet->getCell($column_pajak.$row)->getValue());
                $totalpenjualan = trim($worksheet->getCell($column_totalpenjualan.$row)->getValue()); 
                $pembayaran = trim($worksheet->getCell($column_pembayaran.$row)->getValue());
                $saldo = trim($worksheet->getCell($column_saldo.$row)->getValue());

                if(substr($reference,0,4)=='KSR-' AND strlen($reference)>7) {
                    $jumlah_transaksi = Transaksi::findTransaksiByKanal('zahir',$reference)->count();
                    if($jumlah_transaksi==0) {
                        $anggota_id = Anggota::findOneAnggotaByNomorZahir($pelanggan)->id;
                        $model = new Transaksi();
                        $model->scenario = 'backend-import-zahir';
                        $model->kode_toko=Yii::$app->user->identity->kode_toko;
                        $model->kanal_transaksi = 'zahir';
                        $model->nomor_referensi = $reference;
                        $model->nomor_pesanan = $nopesanan;
                        $model->anggota_nomor_zahir= $pelanggan;
                        $model->anggota_id = $anggota_id;
                        $model->nama_pelanggan = $pelanggan;
                        $model->mata_uang = $matauang;
                        $model->subtotal = $subtotal;
                        $model->diskon = $diskon;
                        $model->pajak = $pajak;
                        $model->total_penjualan = $totalpenjualan;
                        $model->pembayaran = $pembayaran;
                        $model->saldo = $saldo;
                        $model->insert_by = Yii::$app->user->identity->email;
                        if (!$model->save()) $sum_error++;
                    }
                }
            }
            Yii::$app->session->setFlash('success', "Import Selesai, lihat List Transaksi. Jumlah error: ".$sum_error); 
        }
    }
    ?>

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL,'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],'options' => ['enctype' => 'multipart/form-data']]); ?>


    <?php
	echo $form->field($upload, 'attachmentFile')->widget(FileInput::classname());
	?>

    <div class="form-group">
        <?= Html::submitButton('Import Transaksi Zahir', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
