<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use common\models\Produk;
use common\models\Toko;
use yii\helpers\Url;
use yii\web\UploadedFile;

$worksheet_update = 'Ubah - Informasi Penjualan';

$row_mulai = 4;
$column_productid = 'B';
$column_urlid = 'D';
$column_sku = 'H';

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

            $sum_error = 0;
            //inilah looping untuk membaca cell dalam file excel,perkolom
            for ($row = $row_mulai; $row <= $highestRow; ++$row) { //$row = 2 artinya baris kedua yang dibaca dulu(header kolom diskip disesuaikan saja)
                //for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                $productid = $worksheet->getCell($column_productid.$row)->getCalculatedValue();
                $urlid = $worksheet->getCell($column_urlid.$row)->getCalculatedValue();
                $sku = $worksheet->getCell($column_sku.$row)->getCalculatedValue(); //7 artinya kolom STOCK
                
                $toko=Toko::findOne(['kode'=>Yii::$app->user->identity->kode_toko]);

                $skuprefix=array();
                foreach ($toko->attributes as $key => $value) {
                    if(substr($key,0,9)=='skuprefix'&&!empty($value)){
                        array_push($skuprefix,$value);
                    }
                }
                if(in_array(substr($sku,0,5),$skuprefix)) {
                    $model = Produk::findOneProduk($sku);
                    if($model===NULL){
                        continue;
                    }
                    $model->scenario = 'backend-import-urlid';
                    $model->id_tkp = $productid;
                    $model->urlid_tkp = $urlid;
                    if (!$model->save()) $sum_error++;
                }
            }
            Yii::$app->session->setFlash('success', "Import Selesai, cek master produk. Jumlah error: ".$sum_error); 
        }
    }
    ?>

    <p>Lakukan download dari web https://seller.tokopedia.com/bulk/edit > Pilih Informasi Penjualan > Klik Buat Template</p>

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL,'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],'options' => ['enctype' => 'multipart/form-data']]); ?>


    <?php
	echo $form->field($upload, 'attachmentFile')->widget(FileInput::classname());
	?>

    <div class="form-group">
        <?= Html::submitButton('Import URL/ID', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
