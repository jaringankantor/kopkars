<?php

use yii\imagine\Image;
use yii\web\Response;

$response = Yii::$app->getResponse();
$response->format = Response::FORMAT_RAW;
$response->headers->set('Content-Type', 'image/jpeg');

$foto_ke = 'foto_'.$ke;
$image = Image::getImagine()->load(hex2bin(stream_get_contents($model->$foto_ke)));
Image::thumbnail($image, 800, 800)->show('jpg');