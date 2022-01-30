<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "histori_pesanan_pinjaman".
 *
 * @property int $id
 * @property int $anggota_id
 * @property int $pesanan_pinjaman_id
 * @property string $pesanan_pinjaman_kolom
 * @property string $value_old
 * @property string|null $value_new
 * @property string $jenis_transaksi
 * @property string $waktu
 * @property string|null $by
 *
 * @property PesananPinjaman $pesananPinjaman
 */
class HistoriPesananPinjaman extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'histori_pesanan_pinjaman';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['anggota_id', 'pesanan_pinjaman_id', 'pesanan_pinjaman_kolom', 'value_old', 'jenis_transaksi'], 'required'],
            [['anggota_id', 'pesanan_pinjaman_id'], 'default', 'value' => null],
            [['anggota_id', 'pesanan_pinjaman_id'], 'integer'],
            [['waktu'], 'safe'],
            [['pesanan_pinjaman_kolom', 'by'], 'string', 'max' => 50],
            [['value_old', 'value_new'], 'string', 'max' => 255],
            [['jenis_transaksi'], 'string', 'max' => 20],
            [['pesanan_pinjaman_id'], 'exist', 'skipOnError' => true, 'targetClass' => PesananPinjaman::className(), 'targetAttribute' => ['pesanan_pinjaman_id' => 'id']],
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
            'pesanan_pinjaman_id' => 'Pesanan Pinjaman ID',
            'pesanan_pinjaman_kolom' => 'Pesanan Pinjaman Kolom',
            'value_old' => 'Value Old',
            'value_new' => 'Value New',
            'jenis_transaksi' => 'Jenis Transaksi',
            'waktu' => 'Waktu',
            'by' => 'By',
        ];
    }

    /**
     * Gets query for [[PesananPinjaman]].
     *
     * @return \yii\db\ActiveQuery|PesananPinjamanQuery
     */
    public function getPesananPinjaman()
    {
        return $this->hasOne(PesananPinjaman::className(), ['id' => 'pesanan_pinjaman_id']);
    }

    /**
     * {@inheritdoc}
     * @return HistoriPesananPinjamanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HistoriPesananPinjamanQuery(get_called_class());
    }
}
