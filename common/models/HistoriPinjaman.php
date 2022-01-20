<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "histori_pinjaman".
 *
 * @property int $id
 * @property int $anggota_id
 * @property int $pinjaman_id
 * @property string $pinjaman_kolom
 * @property string $value_old
 * @property string|null $value_new
 * @property string $jenis_transaksi
 * @property string $waktu
 * @property string|null $by
 */
class HistoriPinjaman extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'histori_pinjaman';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['anggota_id', 'pinjaman_id', 'pinjaman_kolom', 'value_old', 'jenis_transaksi'], 'required'],
            [['anggota_id', 'pinjaman_id'], 'default', 'value' => null],
            [['anggota_id', 'pinjaman_id'], 'integer'],
            [['waktu'], 'safe'],
            [['pinjaman_kolom', 'by'], 'string', 'max' => 50],
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
            'pinjaman_id' => 'Pinjaman ID',
            'pinjaman_kolom' => 'Pinjaman Kolom',
            'value_old' => 'Value Old',
            'value_new' => 'Value New',
            'jenis_transaksi' => 'Jenis Transaksi',
            'waktu' => 'Waktu',
            'by' => 'By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return HistoriPinjamanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HistoriPinjamanQuery(get_called_class());
    }
}
