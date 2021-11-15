<?php

namespace common\models;
use yii\base\Model;

class UploadForm extends Model
{
    public $attachmentFile;
    public $imageFile;

    public function rules()
    {
        return [
            [['attachmentFile'], 'file', 'skipOnEmpty' => true],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg', 'mimeTypes'=>'image/jpeg', 'maxFiles' => 0],
        ];
    }

}