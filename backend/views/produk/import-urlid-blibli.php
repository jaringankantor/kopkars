<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use common\models\Produk;
use common\models\Toko;
use yii\helpers\Url;
use yii\web\UploadedFile;

$worksheet_update = 'Data';

$row_mulai = 2;
$column_urlid = 'A';
$column_sku = 'E';

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
                $urlid = $worksheet->getCell($column_urlid.$row)->getCalculatedValue(); //5 artinya kolom PRICE
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
                        break;
                    }
                    $model->scenario = 'backend-import-urlid';
                    $model->urlid_bli = $urlid;
                    $model->save();
                }
            }
            Yii::$app->session->setFlash('success', "Import Selesai, cek master produk."); 
        }
    }
    ?>

    <p>Lakukan download dari web https://seller.blibli.com/external/product/active/all > Klik Tindakan Bulk > Download Semua > Akan masuk antrian lalu lihat di notifikasi</p>

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL,'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],'options' => ['enctype' => 'multipart/form-data']]); ?>


    <?php
	echo $form->field($upload, 'attachmentFile')->widget(FileInput::classname());
	?>

    <div class="form-group">
        <?= Html::submitButton('Import URL/ID', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
