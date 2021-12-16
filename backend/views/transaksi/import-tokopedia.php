<?php
use common\models\Anggota;
use common\models\TransaksiRincian;
use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\UploadedFile;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;

$worksheet_update = 'Sheet1';

$row_mulai = 9;
$column_nomor_referensi = 'C';
$column_waktu = 'D';
$column_nama_produk = 'G';
$column_jumlah_barang = 'H';
$column_sku = 'I';
$column_keterangan = 'J';
$column_harga_awal = 'K';
$column_diskon = 'L'; //Jika ada subsidi masukan ke kolom ini juga (dianggap diskon tambahan)
$column_harga_jual = 'N';
$column_nama_pelanggan = 'O';
$column_nomor_hp = 'P';
$column_alamat = 'S';
$column_kurir = 'T';
$column_nomor_resi = 'T';
$column_is_bebasongkir = 'AA';

$this->title = 'Import Tokopedia';
//$this->params['breadcrumbs'][] = $this->title;

?>

<div class="transaksi-import-zahir">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Lakukan export data transaksi dari aplikasi Tokopedia, dengan cara: </p>
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

                $nomor_referensi = trim($worksheet->getCell($column_nomor_referensi.$row)->getValue());

                $waktu = date_format(date_create(trim($worksheet->getCell($column_waktu.$row)->getValue())),"Y-m-d H:i:s");

                $nama_produk = trim($worksheet->getCell($column_nama_produk.$row)->getValue());
                $jumlah_barang = trim($worksheet->getCell($column_jumlah_barang.$row)->getValue());
                $sku = trim($worksheet->getCell($column_sku.$row)->getValue());
                $keterangan = trim($worksheet->getCell($column_keterangan.$row)->getValue());

                $anggota_id = Anggota::findAnggotaByNomorAnggota($keterangan)->count()==1?Anggota::findOneAnggotaByNomorAnggota($keterangan)->id:null;

                $harga_awal = trim($worksheet->getCell($column_harga_awal.$row)->getValue());
                $diskon = trim($worksheet->getCell($column_diskon.$row)->getValue());
                $harga_jual = trim($worksheet->getCell($column_harga_jual.$row)->getValue());

                $subtotal = $harga_awal*$jumlah_barang;

                if($nomor_referensi='INV/20200927/XX/IX/638680882'){
                print_r($harga_awal.$jumlah_barang);
                exit();
            }
                $total_penjualan = $harga_jual*$jumlah_barang;
                $pembayaran = $total_penjualan;

                $nama_pelanggan = trim($worksheet->getCell($column_nama_pelanggan.$row)->getValue());
                $nomor_hp = trim($worksheet->getCell($column_nomor_hp.$row)->getValue());
                $alamat = trim($worksheet->getCell($column_alamat.$row)->getValue());
                $kurir = trim($worksheet->getCell($column_kurir.$row)->getValue());
                $nomor_resi = trim($worksheet->getCell($column_nomor_resi.$row)->getValue());

                $is_bebasongkir = trim($worksheet->getCell($column_is_bebasongkir.$row)->getValue())=='Yes'?true:false;

                if(substr($nomor_referensi,0,6)=='INV/20' AND strlen($nomor_referensi)>25) {
                    $jumlah_transaksi = TransaksiRincian::findTransaksiRincianByKanal('tokopedia',$nomor_referensi,$nama_produk)->count();
                    if($jumlah_transaksi==0) {
                        $anggota_id = Anggota::findOneAnggotaByNomorZahir($pelanggan)->id;
                        $model = new TransaksiRincian();
                        $model->scenario = 'backend-import-tokopedia';
                        $model->kode_toko=Yii::$app->user->identity->kode_toko;
                        $model->kanal_transaksi = 'tokopedia';
                        $model->nomor_referensi = $nomor_referensi;
                        //$model->nomor_pesanan = $nopesanan;
                        $model->sku = $sku;
                        $model->anggota_id = $anggota_id;
                        $model->nama_pelanggan = $nama_pelanggan;
                        $model->nomor_hp = $nomor_hp;
                        //$model->email = $email;
                        $model->alamat = $alamat;
                        $model->kurir = $kurir;
                        $model->nomor_resi = $nomor_resi;
                        $model->is_bebasongkir = $is_bebasongkir;
                        $model->nama_produk = $nama_produk;
                        $model->jumlah_barang = $jumlah_barang;
                        //$model->mata_uang = $mata_uang;
                        $model->harga_awal = $harga_awal;
                        $model->diskon = $diskon;
                        //$model->pajak = $pajak;
                        $model->harga_jual = $harga_jual;
                        $model->subtotal = $subtotal;
                        $model->total_penjualan = $total_penjualan;
                        $model->pembayaran = $pembayaran;
                        //$model->saldo = $saldo;
                        $model->keterangan = $keterangan;
                        $model->waktu = $waktu;
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
        <?= Html::submitButton('Import Transaksi Tokopedia', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
