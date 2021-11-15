<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "variabel_statuskaryawan".
 *
 * @property string $statuskaryawan
 *
 * @property Anggota[] $anggota
 */
class VariabelStatuskaryawan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'variabel_statuskaryawan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['statuskaryawan'], 'required'],
            [['statuskaryawan'], 'string', 'max' => 20],
            [['statuskaryawan'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'statuskaryawan' => 'Statuskaryawan',
        ];
    }

    /**
     * Gets query for [[Anggota]].
     *
     * @return \yii\db\ActiveQuery|AnggotaQuery
     */
    public function getAnggota()
    {
        return $this->hasMany(Anggota::className(), ['statuskaryawan' => 'statuskaryawan']);
    }

    /**
     * {@inheritdoc}
     * @return VariabelStatuskaryawanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VariabelStatuskaryawanQuery(get_called_class());
    }
}
