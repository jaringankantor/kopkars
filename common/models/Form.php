<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "form".
 *
 * @property string $kode
 * @property string $sheet_name
 * @property int $baris_header
 * @property int $baris_isi
 * @property string|null $deskripsi
 * @property resource|null $file_excel
 * @property string|null $file_extension
 * @property string|null $file_name
 * @property int|null $file_size
 * @property string|null $file_type
 *
 * @property FormField[] $formFields
 */
class Form extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'form';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode'], 'required'],
            [['baris_header', 'baris_isi', 'file_size'], 'default', 'value' => null],
            [['baris_header', 'baris_isi', 'file_size'], 'integer'],
            [['file_excel'], 'file', 'extensions' => 'xls,xlsx'],
            [['kode', 'sheet_name', 'file_name', 'file_type'], 'string', 'max' => 150],
            [['deskripsi'], 'string', 'max' => 2000],
            [['file_extension'], 'string', 'max' => 10],
            [['kode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode' => 'Kode',
            'sheet_name' => 'Sheet Name',
            'baris_header' => 'Baris Header',
            'baris_isi' => 'Baris Isi',
            'deskripsi' => 'Deskripsi',
            'file_excel' => 'File Excel',
            'file_extension' => 'File Extension',
            'file_name' => 'File Name',
            'file_size' => 'File Size',
            'file_type' => 'File Type',
        ];
    }

    /**
     * Gets query for [[FormFields]].
     *
     * @return \yii\db\ActiveQuery|FormFieldQuery
     */
    public function getFormFields()
    {
        return $this->hasMany(FormField::className(), ['kode_form' => 'kode']);
    }

    /**
     * {@inheritdoc}
     * @return FormQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FormQuery(get_called_class());
    }
}
