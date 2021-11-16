<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use kartik\widgets\Select2; // or kartik\select2\Select2
use common\models\Produk;
use common\models\Toko;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\UploadedFile;

/* @var $this yii\web\View */
/* @var $model backend\models\Produk */
/* @var $form yii\widgets\ActiveForm */


if (Yii::$app->request->isPost) {
    $upload->imageFile = UploadedFile::getInstances($upload, 'imageFile');
    if ($upload->imageFile && $upload->validate()) {
        $error_file = null;
        foreach ($upload->imageFile as $file) {
            $baseName = $file->baseName;

            $toko=Toko::findOne(['kode'=>Yii::$app->user->identity->kode_toko]);
            
            $skuprefix=array();
            foreach ($toko->attributes as $key => $value) {
                if(substr($key,0,9)=='skuprefix'&&!empty($value)){
                    array_push($skuprefix,$value);
                }
            }
            
            $data_file = explode(" ",$baseName);
            if (!in_array(substr($data_file[0],0,5),$skuprefix) && !in_array(substr($data_file[2],1,1),array(1,2,3,4,5,6,7))) {
                $error_file .= $file->baseName.', ';
            } else {

                $model = Produk::findOneProduk($data_file[0]);

                $model->scenario = 'backend-import-foto';

                switch (substr($data_file[1],1,1)) {
                    case 1:
                        $model->foto_1 = bin2hex(file_get_contents($file->tempName));
                        break;
                    case 2:
                        $model->foto_2 = bin2hex(file_get_contents($file->tempName));
                        break;
                    case 3:
                        $model->foto_3 = bin2hex(file_get_contents($file->tempName));
                        break;
                    case 4:
                        $model->foto_4 = bin2hex(file_get_contents($file->tempName));
                        break;
                    case 5:
                        $model->foto_5 = bin2hex(file_get_contents($file->tempName));
                        break;
                    case 6:
                        $model->foto_6 = bin2hex(file_get_contents($file->tempName));
                        break;
                    case 7:
                        $model->foto_7 = bin2hex(file_get_contents($file->tempName));
                        break;
                }
                $model->save();
                
            }
        }
        if($error_file ==null) {
            Yii::$app->session->setFlash('success', "Import Selesai, cek master produk.");
        } else {
            Yii::$app->session->setFlash('error', "Penamaan file salah: ".$error_file);
        }
    }
}
?>

<div class="import-deskripsi">

    <p>
        Contoh Format penulisan file yang WAJIB diikuti:<br>
        <?php
        $toko=Toko::findOne(['kode'=>Yii::$app->user->identity->kode_toko]);

        $skuprefix=array();
        foreach ($toko->attributes as $key => $value) {
            if(substr($key,0,9)=='skuprefix'&&!empty($value)){
                echo $value.'0001 (1).jpg, '.$value.'0001 (2).jpg, '.$value.'0001 (3).jpg, '.$value.'0001 (4).jpg, '.$value.'0001 (5).jpg<br>';
            }
        }
        ?>
    </p>

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL,'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],'options' => ['enctype' => 'multipart/form-data']]); ?>


    <?php
	echo $form->field($upload, 'imageFile[]')->widget(FileInput::classname(),[
        'options' => ['multiple' => true, 'accept' => 'image/*'],
        'pluginOptions' => ['previewFileType' => 'image'],
    ]);
	?>

    <div class="form-group">
        <?= Html::submitButton('Import Foto Produk', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
