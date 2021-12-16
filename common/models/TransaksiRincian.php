<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "transaksi_rincian".
 *
 * @property int $id
 * @property string $kode_toko
 * @property string $kanal_transaksi
 * @property string $nomor_referensi
 * @property string|null $nomor_pesanan
 * @property string|null $sku
 * @property int|null $anggota_id
 * @property string|null $nama_pelanggan
 * @property string|null $nomor_hp
 * @property string|null $email
 * @property string|null $alamat
 * @property string|null $kurir
 * @property string|null $nomor_resi
 * @property bool|null $is_bebasongkir
 * @property string $nama_produk
 * @property int $jumlah_barang
 * @property string $mata_uang
 * @property int $harga_awal
 * @property int|null $diskon
 * @property int|null $pajak
 * @property int $harga_jual
 * @property int $subtotal
 * @property int $total_penjualan
 * @property int|null $pembayaran
 * @property int|null $saldo
 * @property string|null $keterangan
 * @property string $waktu
 * @property string|null $last_waktu_update
 * @property string $insert_by
 * @property string|null $last_update_by
 * @property bool|null $is_deleted
 * @property string|null $deleted_at
 * @property string|null $last_softdelete_by
 *
 * @property Toko $kodeToko
 * @property VariabelKanalTransaksi $kanalTransaksi
 */
class TransaksiRincian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaksi_rincian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_toko', 'kanal_transaksi', 'nomor_referensi', 'nama_produk', 'jumlah_barang', 'harga_awal', 'harga_jual', 'subtotal', 'total_penjualan', 'insert_by'], 'required'],
            [['anggota_id', 'jumlah_barang', 'harga_awal', 'diskon', 'pajak', 'harga_jual', 'subtotal', 'total_penjualan', 'pembayaran', 'saldo'], 'default', 'value' => null],
            [['anggota_id', 'jumlah_barang', 'harga_awal', 'diskon', 'pajak', 'harga_jual', 'subtotal', 'total_penjualan', 'pembayaran', 'saldo'], 'integer'],
            [['is_bebasongkir', 'is_deleted'], 'boolean'],
            [['waktu', 'last_waktu_update', 'deleted_at'], 'safe'],
            [['kode_toko', 'nomor_referensi', 'nomor_pesanan', 'nama_pelanggan', 'nomor_hp', 'email', 'kurir', 'nomor_resi', 'insert_by', 'last_update_by', 'last_softdelete_by'], 'string', 'max' => 50],
            [['kanal_transaksi', 'sku'], 'string', 'max' => 20],
            [['alamat', 'keterangan'], 'string', 'max' => 255],
            [['nama_produk'], 'string', 'max' => 70],
            [['mata_uang'], 'string', 'max' => 6],
            [['kode_toko', 'kanal_transaksi', 'nomor_pesanan'], 'unique', 'targetAttribute' => ['kode_toko', 'kanal_transaksi', 'nomor_pesanan']],
            [['kode_toko', 'kanal_transaksi', 'nomor_referensi'], 'unique', 'targetAttribute' => ['kode_toko', 'kanal_transaksi', 'nomor_referensi']],
            [['kode_toko'], 'exist', 'skipOnError' => true, 'targetClass' => Toko::className(), 'targetAttribute' => ['kode_toko' => 'kode']],
            [['kanal_transaksi'], 'exist', 'skipOnError' => true, 'targetClass' => VariabelKanalTransaksi::className(), 'targetAttribute' => ['kanal_transaksi' => 'kanal_transaksi']],
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
            'kanal_transaksi' => 'Kanal Transaksi',
            'nomor_referensi' => 'Nomor Referensi',
            'nomor_pesanan' => 'Nomor Pesanan',
            'sku' => 'Sku',
            'anggota_id' => 'Anggota ID',
            'nama_pelanggan' => 'Nama Pelanggan',
            'nomor_hp' => 'Nomor Hp',
            'email' => 'Email',
            'alamat' => 'Alamat',
            'kurir' => 'Kurir',
            'nomor_resi' => 'Nomor Resi',
            'is_bebasongkir' => 'Is Bebasongkir',
            'nama_produk' => 'Nama Produk',
            'jumlah_barang' => 'Jumlah Barang',
            'mata_uang' => 'Mata Uang',
            'harga_awal' => 'Harga Awal',
            'diskon' => 'Diskon',
            'pajak' => 'Pajak',
            'harga_jual' => 'Harga Jual',
            'subtotal' => 'Subtotal',
            'total_penjualan' => 'Total Penjualan',
            'pembayaran' => 'Pembayaran',
            'saldo' => 'Saldo',
            'keterangan' => 'Keterangan',
            'waktu' => 'Waktu',
            'last_waktu_update' => 'Last Waktu Update',
            'insert_by' => 'Insert By',
            'last_update_by' => 'Last Update By',
            'is_deleted' => 'Is Deleted',
            'deleted_at' => 'Deleted At',
            'last_softdelete_by' => 'Last Softdelete By',
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['default'] = [];
        $scenarios['backend-import-tokopedia'] = ['kode_toko','kanal_transaksi','nomor_referensi','sku',
        'anggota_id','nama_pelanggan','nomor_hp','alamat','kurir','nomor_resi','is_bebasongkir','nama_produk',
        'jumlah_barang','harga_awal','diskon','harga_jual','subtotal','total_penjualan','pembayaran',
        'keterangan'];
        return $scenarios;
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
     * Gets query for [[KanalTransaksi]].
     *
     * @return \yii\db\ActiveQuery|VariabelKanalTransaksiQuery
     */
    public function getKanalTransaksi()
    {
        return $this->hasOne(VariabelKanalTransaksi::className(), ['kanal_transaksi' => 'kanal_transaksi']);
    }

    /**
     * {@inheritdoc}
     * @return TransaksiRincianQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TransaksiRincianQuery(get_called_class());
    }

    public static function findTransaksiRincian()
    {
        return self::find()
            ->where(['kode_toko'=>Yii::$app->user->identity->kode_toko]);
    }

    public static function findOneTransaksiRincian($id)
    {
        return self::findTransaksiRincian()
            ->andWhere(['id'=>$id])
            ->one();
    }

    public static function findTransaksiRincianByKanal($kanal_transaksi,$nomor_referensi)
    {
        return self::findTransaksiRincian()
            ->andWhere(['kanal_transaksi'=>$kanal_transaksi])
            ->andWhere(['nomor_referensi'=>$nomor_referensi]);
    }

}
