<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pesanan_pinjaman".
 *
 * @property int $id
 * @property string $kode_toko
 * @property int $anggota_id
 * @property string|null $nomor_referensi
 * @property int $saldo_pokok
 * @property int $saldo_jasa
 * @property int $total_pembayaran
 * @property string|null $mulai_tanggal_pembayaran
 * @property string|null $rencana_tanggal_pelunasan
 * @property string|null $aktual_tanggal_pelunasan
 * @property string|null $peruntukan
 * @property resource|null $lampiran
 * @property string|null $keterangan
 * @property string $waktu
 * @property string|null $last_update_by
 * @property bool|null $is_approved_level1
 * @property bool|null $is_approved_level2
 * @property bool|null $is_processed
 *
 * @property HistoriPesananPinjaman[] $historiPesananPinjaman
 * @property Anggota $anggota
 * @property Toko $kodeToko
 * @property Pinjaman[] $pinjaman
 */
class PesananPinjaman extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pesanan_pinjaman';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_toko', 'anggota_id', 'saldo_pokok', 'saldo_jasa'], 'required'],
            [['anggota_id', 'saldo_pokok', 'saldo_jasa', 'total_pembayaran'], 'default', 'value' => null],
            [['anggota_id', 'saldo_pokok', 'saldo_jasa', 'total_pembayaran'], 'integer'],
            [['mulai_tanggal_pembayaran', 'rencana_tanggal_pelunasan', 'aktual_tanggal_pelunasan', 'waktu'], 'safe'],
            [['lampiran'], 'string'],
            [['is_approved_level1', 'is_approved_level2', 'is_processed'], 'boolean'],
            [['kode_toko', 'nomor_referensi', 'last_update_by'], 'string', 'max' => 50],
            [['peruntukan', 'keterangan'], 'string', 'max' => 255],
            [['anggota_id'], 'exist', 'skipOnError' => true, 'targetClass' => Anggota::className(), 'targetAttribute' => ['anggota_id' => 'id']],
            [['kode_toko'], 'exist', 'skipOnError' => true, 'targetClass' => Toko::className(), 'targetAttribute' => ['kode_toko' => 'kode']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode_toko' => 'Kode Toko',
            'anggota_id' => 'Anggota ID',
            'nomor_referensi' => 'Nomor Referensi',
            'saldo_pokok' => 'Saldo Pokok',
            'saldo_jasa' => 'Saldo Jasa',
            'total_pembayaran' => 'Total Pembayaran',
            'mulai_tanggal_pembayaran' => 'Mulai Tanggal Pembayaran',
            'rencana_tanggal_pelunasan' => 'Rencana Tanggal Pelunasan',
            'aktual_tanggal_pelunasan' => 'Aktual Tanggal Pelunasan',
            'peruntukan' => 'Peruntukan',
            'lampiran' => 'Lampiran',
            'keterangan' => 'Keterangan',
            'waktu' => 'Waktu',
            'last_update_by' => 'Last Update By',
            'is_approved_level1' => 'Is Approved Level1',
            'is_approved_level2' => 'Is Approved Level2',
            'is_processed' => 'Is Processed',
        ];
    }

    /**
     * Gets query for [[HistoriPesananPinjaman]].
     *
     * @return \yii\db\ActiveQuery|HistoriPesananPinjamanQuery
     */
    public function getHistoriPesananPinjaman()
    {
        return $this->hasMany(HistoriPesananPinjaman::className(), ['pesanan_pinjaman_id' => 'id']);
    }

    /**
     * Gets query for [[Anggota]].
     *
     * @return \yii\db\ActiveQuery|AnggotaQuery
     */
    public function getAnggota()
    {
        return $this->hasOne(Anggota::className(), ['id' => 'anggota_id']);
    }

    /**
     * Gets query for [[KodeToko]].
     *
     * @return \yii\db\ActiveQuery|TokoQuery
     */
    public function getKodeToko()
    {
        return $this->hasOne(Toko::className(), ['kode' => 'kode_toko']);
    }

    /**
     * Gets query for [[Pinjaman]].
     *
     * @return \yii\db\ActiveQuery|PinjamanQuery
     */
    public function getPinjaman()
    {
        return $this->hasMany(Pinjaman::className(), ['pesanan_pinjaman_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return PesananPinjamanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PesananPinjamanQuery(get_called_class());
    }
}
