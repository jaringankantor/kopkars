<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "field".
 *
 * @property string $kode
 * @property string|null $deskripsi
 *
 * @property FormField[] $formFields
 * @property Form[] $kodeForms
 */
class Field extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'field';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode'], 'required'],
            [['kode'], 'string', 'max' => 50],
            [['deskripsi'], 'string', 'max' => 2000],
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
            'deskripsi' => 'Deskripsi',
        ];
    }

    /**
     * Gets query for [[FormFields]].
     *
     * @return \yii\db\ActiveQuery|FormFieldQuery
     */
    public function getFormFields()
    {
        return $this->hasMany(FormField::className(), ['kode_field' => 'kode']);
    }

    /**
     * Gets query for [[KodeForms]].
     *
     * @return \yii\db\ActiveQuery|FormQuery
     */
    public function getKodeForms()
    {
        return $this->hasMany(Form::className(), ['kode' => 'kode_form'])->viaTable('form_field', ['kode_field' => 'kode']);
    }

    /**
     * {@inheritdoc}
     * @return FieldQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FieldQuery(get_called_class());
    }
}
