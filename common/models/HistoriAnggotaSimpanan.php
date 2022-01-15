<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "histori_anggota_simpanan".
 *
 * @property int $id
 * @property int $anggota_id
 * @property int $anggota_simpanan_id
 * @property string $anggota_simpanan_kolom
 * @property string $value_old
 * @property string|null $value_new
 * @property string $jenis_transaksi
 * @property string $waktu
 * @property string|null $by
 */
class HistoriAnggotaSimpanan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'histori_anggota_simpanan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['anggota_id', 'anggota_simpanan_id', 'anggota_simpanan_kolom', 'value_old', 'jenis_transaksi'], 'required'],
            [['anggota_id', 'anggota_simpanan_id'], 'default', 'value' => null],
            [['anggota_id', 'anggota_simpanan_id'], 'integer'],
            [['waktu'], 'safe'],
            [['anggota_simpanan_kolom', 'by'], 'string', 'max' => 50],
            [['value_old', 'value_new'], 'string', 'max' => 255],
            [['jenis_transaksi'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'anggota_id' => 'Anggota ID',
            'anggota_simpanan_id' => 'Anggota Simpanan ID',
            'anggota_simpanan_kolom' => 'Anggota Simpanan Kolom',
            'value_old' => 'Value Old',
            'value_new' => 'Value New',
            'jenis_transaksi' => 'Jenis Transaksi',
            'waktu' => 'Waktu',
            'by' => 'By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return HistoriAnggotaSimpananQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HistoriAnggotaSimpananQuery(get_called_class());
    }
}
