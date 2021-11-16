<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "form_field".
 *
 * @property int $id
 * @property string $kode_form
 * @property string|null $kode_field
 * @property string $nama_field_excel
 * @property string|null $deskripsi
 *
 * @property Field $kodeField
 * @property Form $kodeForm
 */
class FormField extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'form_field';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_form', 'kode_field','nama_field_excel'], 'required'],
            [['kode_form', 'kode_field'], 'string', 'max' => 50],
            [['nama_field_excel'], 'string', 'max' => 70],
            [['deskripsi'], 'string', 'max' => 2000],
            [['kode_field'], 'exist', 'skipOnError' => true, 'targetClass' => Field::className(), 'targetAttribute' => ['kode_field' => 'kode']],
            [['kode_form'], 'exist', 'skipOnError' => true, 'targetClass' => Form::className(), 'targetAttribute' => ['kode_form' => 'kode']],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['backend-create-form'] = ['kode_form', 'nama_field_excel'];
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode_form' => 'Kode Form',
            'kode_field' => 'Kode Field',
            'nama_field_excel' => 'Nama Field Excel',
            'deskripsi' => 'Deskripsi',
        ];
    }

    /**
     * Gets query for [[KodeField]].
     *
     * @return \yii\db\ActiveQuery|FieldQuery
     */
    public function getKodeField()
    {
        return $this->hasOne(Field::className(), ['kode' => 'kode_field']);
    }

    /**
     * Gets query for [[KodeForm]].
     *
     * @return \yii\db\ActiveQuery|FormQuery
     */
    public function getKodeForm()
    {
        return $this->hasOne(Form::className(), ['kode' => 'kode_form']);
    }

    /**
     * {@inheritdoc}
     * @return FormFieldQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FormFieldQuery(get_called_class());
    }
}
