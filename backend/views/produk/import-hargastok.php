<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use common\models\Produk;
use common\models\Toko;
use yii\web\UploadedFile;

$worksheet_update = 'inventory';

$column_harga = 'E';
$column_stok = 'G';
$column_sku = 'I';

/* @var $this yii\web\View */
/* @var $model backend\models\Produk */
/* @var $form yii\widgets\ActiveForm */

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
        for ($row = 2; $row <= $highestRow; ++$row) { //$row = 2 artinya baris kedua yang dibaca dulu(header kolom diskip disesuaikan saja)
            //for ($col = 1; $col <= $highestColumnIndex; ++$col) {
            $harga = $worksheet->getCell($column_harga.$row)->getValue(); //5 artinya kolom PRICE
            $stok = $worksheet->getCell($column_stok.$row)->getValue(); //7 artinya kolom STOCK
            $sku = $worksheet->getCell($column_sku.$row)->getValue(); //9 artinya kolom SKU
            
            $toko=Toko::findOne(['kode'=>Yii::$app->user->identity->kode_toko]);

            $skuprefix=array();
            foreach ($toko->attributes as $key => $value) {
                if(substr($key,0,9)=='skuprefix'&&!empty($value)){
                    array_push($skuprefix,$value);
                }
            }
            if(in_array(substr($sku,0,5),$skuprefix)) {
                $model = Produk::findOneProduk($sku);
                $model->scenario = 'backend-import-hargastok';
                $model->harga_async = $harga;
                $model->stok_async = $stok;
                $model->save();
            }
        }
        Yii::$app->session->setFlash('success', "Import Selesai, cek master produk."); 
    }
}
?>

<div class="import-hargastok">

    <p>Lakukan download dari web INVENTORY ZOBAZE</p>

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL,'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],'options' => ['enctype' => 'multipart/form-data']]); ?>


    <?php
	echo $form->field($upload, 'attachmentFile')->widget(FileInput::classname());
	?>

    <div class="form-group">
        <?= Html::submitButton('Import Harga & Stok', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
