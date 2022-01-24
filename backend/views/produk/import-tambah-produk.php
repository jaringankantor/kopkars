<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use common\models\Produk;
use common\models\Toko;
use yii\helpers\Url;
use yii\web\UploadedFile;

$worksheet_update = 'Sheet1';

$row_mulai = 2;
$column_sku = 'A';
$column_nama_produk = 'B';
$column_brand = 'C';
$column_warna = 'D';
$column_deskripsi = 'E';
$column_harga_async = 'F';
$column_harga_modal_async = 'G';
$column_stok_async = 'H';
$column_berat = 'I';
$column_video_url_1 = 'J';
$column_video_url_2 = 'K';
$column_video_url_3 = 'L';


?>

<div class="col-md-3">
    <?= $this->render('_menu-kiri') ?>
</div>

<div class="col-md-8">
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

            //inilah looping untuk membaca cell dalam file excel,perkolom
            for ($row = $row_mulai; $row <= $highestRow; ++$row) { //$row = 2 artinya baris kedua yang dibaca dulu(header kolom diskip disesuaikan saja)
                //for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                
                $sku = $worksheet->getCell($column_sku.$row)->getValue();
                $nama_produk = $worksheet->getCell($column_nama_produk.$row)->getValue();
                $brand = $worksheet->getCell($column_brand.$row)->getValue();
                $warna = $worksheet->getCell($column_warna.$row)->getValue();
                $deskripsi = $worksheet->getCell($column_deskripsi.$row)->getValue();
                $harga_async = $worksheet->getCell($column_harga_async.$row)->getValue();
                $harga_modal_async = $worksheet->getCell($column_harga_modal_async.$row)->getValue();
                $stok_async = $worksheet->getCell($column_stok_async.$row)->getValue();
                $berat = $worksheet->getCell($column_berat.$row)->getValue();
                $video_url_1 = $worksheet->getCell($column_video_url_1.$row)->getValue();
                $video_url_2 = $worksheet->getCell($column_video_url_2.$row)->getValue();
                $video_url_3 = $worksheet->getCell($column_video_url_3.$row)->getValue();

                $toko=Toko::findOne(['kode'=>Yii::$app->user->identity->kode_toko]);

                $skuprefix=array();
                foreach ($toko->attributes as $key => $value) {
                    if(substr($key,0,9)=='skuprefix'&&!empty($value)){
                        array_push($skuprefix,$value);
                    }
                }

                if(in_array(substr($sku,0,5),$skuprefix)) {
                    $model = new Produk();

                    $model->scenario = 'backend-import-tambah-produk';
                    $model->kode_toko = Yii::$app->user->identity->kode_toko;
                    $model->sku = $sku;
                    $model->nama_produk = $nama_produk;
                    $model->brand = $brand;
                    $model->warna = $warna;
                    $model->deskripsi = $deskripsi;
                    $model->harga_async = $harga_async;
                    $model->harga_modal_async = $harga_modal_async;
                    $model->stok_async = $stok_async;
                    $model->berat = $berat;
                    $model->video_url_1 = $video_url_1;
                    $model->video_url_2 = $video_url_2;
                    $model->video_url_3 = $video_url_3;

                    $model->save();
                }
            }
            Yii::$app->session->setFlash('success', "Import Tambah Selesai, cek master produk."); 
        }
    }
    ?>

    <p>
        <?= Html::a('Download Template', Url::to('@web/public/docs/template-import-produk.xlsx'), ['class' => 'btn btn-success']) ?>
    </p>

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL,'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],'options' => ['enctype' => 'multipart/form-data']]); ?>


    <?php
	echo $form->field($upload, 'attachmentFile')->widget(FileInput::classname());
	?>

    <div class="form-group">
        <?= Html::submitButton('Import Tambah Produk', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
