<?php
use common\models\Anggota;
use common\models\TransaksiRincian;
use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\UploadedFile;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;

$worksheet_update = 'sheet1';

$row_mulai = 2;
$column_nomor_referensi_rincian = 'A';
$column_sku = 'F';
$column_waktu = 'J';
$column_nomor_referensi = 'M';
$column_nama_pelanggan = 'T';
$column_alamat_1 = 'U';
$column_alamat_2 = 'Y';
$column_alamat_3 = 'X';
$column_alamat_4 = 'W';
$column_nomor_hp = 'AL';
$column_harga_jual = 'AU';
$column_harga_awal = 'AV';
$column_diskon = 'AW'; //Jika ada subsidi masukan ke kolom ini juga (dianggap diskon tambahan)
$column_is_bebasongkir = 'AX';
$column_nama_produk = 'AZ';
$column_kurir = 'BC';
$column_nomor_resi = 'BG';

//$column_jumlah_barang = 'H';
//$column_keterangan = 'J';
//$column_alamat = 'S';

$this->title = 'Import Lazada';
//$this->params['breadcrumbs'][] = $this->title;

?>

<div class="transaksi-import-lazada">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Lakukan export data transaksi dari aplikasi Lazada, dengan cara: Klik menu Pesanan > Pesanan > Diterima > Export > Export Tab Saat Ini. Download laporan di Lihar Riwayat > Lihat Riwayat Ekspor</p>
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

                $sku = Yii::$app->kopkarstext->textOrNull(trim($worksheet->getCell($column_sku.$row)->getValue()));

                $nomor_referensi = trim($worksheet->getCell($column_nomor_referensi.$row)->getValue());
                $nomor_referensi_rincian = trim($worksheet->getCell($column_nomor_referensi_rincian.$row)->getValue());

                $waktu = date_format(date_create(trim($worksheet->getCell($column_waktu.$row)->getValue())),"Y-m-d H:i:s");

                $nama_produk = trim($worksheet->getCell($column_nama_produk.$row)->getValue());
                
                $jumlah_barang = 1;
                
                //$keterangan = Yii::$app->kopkarstext->textOrNull(trim($worksheet->getCell($column_keterangan.$row)->getValue()));

                //$anggota_id = Anggota::findAnggotaByNomorAnggota($keterangan)->count()==1?Anggota::findOneAnggotaByNomorAnggota($keterangan)->id:null;

                $harga_awal = intval(trim($worksheet->getCell($column_harga_awal.$row)->getValue()));
                $diskon = intval(trim($worksheet->getCell($column_diskon.$row)->getValue()));
                $harga_jual = intval(trim($worksheet->getCell($column_harga_jual.$row)->getValue()));

                $subtotal = $harga_awal*$jumlah_barang;

                $total_penjualan = $harga_jual*$jumlah_barang;
                $pembayaran = $total_penjualan;

                $nama_pelanggan = trim($worksheet->getCell($column_nama_pelanggan.$row)->getValue());
                $nomor_hp = trim($worksheet->getCell($column_nomor_hp.$row)->getValue());

                $alamat = trim($worksheet->getCell($column_alamat_1.$row)->getValue()).' '.trim($worksheet->getCell($column_alamat_2.$row)->getValue()).' '.trim($worksheet->getCell($column_alamat_3.$row)->getValue()).' '.trim($worksheet->getCell($column_alamat_4.$row)->getValue());

                $kurir = trim($worksheet->getCell($column_kurir.$row)->getValue());
                $nomor_resi = trim($worksheet->getCell($column_nomor_resi.$row)->getValue());

                $is_bebasongkir = trim($worksheet->getCell($column_is_bebasongkir.$row)->getValue())=='0.00'?true:false;

                if(substr($sku,0,3)=='SKU' AND is_numeric($nomor_referensi) AND strlen($nomor_referensi)>12) {
                    $transaksi_rincian = TransaksiRincian::findTransaksiRincianByKanal('lazada',$nomor_referensi,$nama_produk);
                    $jumlah_transaksi = $transaksi_rincian->count();
                    $transaksi_rincian_id = $transaksi_rincian->one()->id;
                    if($jumlah_transaksi==0) {
                        $model = new TransaksiRincian();
                        $model->scenario = 'backend-import-marketplace';
                        $model->kode_toko=Yii::$app->user->identity->kode_toko;
                        $model->kanal_transaksi = 'lazada';
                        $model->nomor_referensi = $nomor_referensi;
                        $model->nomor_referensi_rincian = $nomor_referensi_rincian;
                        //$model->nomor_pesanan = $nopesanan;
                        $model->sku = $sku;
                        //$model->anggota_id = $anggota_id;
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

                        if (!$model->save()) {
                            print_r($model);
                            exit();
                            $sum_error++;
                        }
                    } else {
                        $model = TransaksiRincian::findOneTransaksiRincian($transaksi_rincian_id);
                        if(strpos($model->nomor_referensi_rincian,$nomor_referensi_rincian)){
                            $model->nomor_referensi_rincian = $model->nomor_referensi_rincian.'||'.$nomor_referensi_rincian;
                            $model->jumlah_barang = $model->jumlah_barang+$jumlah_barang;
                            $model->subtotal = $model->jumlah_barang*$model->harga_awal;
                            $model->total_penjualan = $model->jumlah_barang*$model->harga_jual;
                            $model->pembayaran = $model->total_penjualan;
                            

                            if (!$model->save())$sum_error++;
                        }
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
        <?= Html::submitButton('Import Transaksi Lazada', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
