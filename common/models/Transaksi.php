<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii2tech\ar\softdelete\SoftDeleteBehavior;
use yii2tech\ar\softdelete\SoftDeleteQueryBehavior;

/**
 * This is the model class for table "transaksi".
 *
 * @property int $id
 * @property string $kode_toko
 * @property string $kanal_transaksi
 * @property string $nomor_referensi
 * @property string|null $nomor_pesanan
 * @property int|null $anggota_id
 * @property string|null $anggota_nomor_zahir
 * @property string|null $nama_pelanggan
 * @property string|null $nomor_hp 
 * @property string|null $email 
 * @property string|null $alamat
 * @property string|null $kurir
 * @property string|null $nomor_resi 
 * @property string $mata_uang
 * @property int $subtotal
 * @property int|null $diskon
 * @property int|null $pajak
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
 * @property Toko $kodeToko
 *
 * @property Anggota $anggota
 * @property VariabelKanalTransaksi $kanalTransaksi
 */
class Transaksi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaksi';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['waktu'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['last_waktu_update'],
                ],
                 'value' => 'now()'
            ],
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'is_deleted' => true,
                    'deleted_at' => date("Y-m-d H:i:s"),
                    'last_softdelete_by' => Yii::$app->user->identity->email,
                ],
                'replaceRegularDelete' => true // mutate native `delete()` method
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_toko', 'kanal_transaksi', 'nomor_referensi', 'subtotal', 'total_penjualan', 'insert_by'], 'required'],
            [['kode_toko', 'nomor_referensi', 'nomor_pesanan'], 'string', 'max' => 50],
            ['kode_toko', 'match' ,'pattern'=>'/^[A-Za-z0-9._-]+$/u','message'=> 'Only alphanumeric, dot(.), underscore(_), and hypen(-)'],
            [['anggota_id', 'subtotal', 'diskon', 'pajak', 'total_penjualan', 'pembayaran', 'saldo'], 'default', 'value' => null],
            [['anggota_id', 'subtotal', 'diskon', 'pajak', 'total_penjualan', 'pembayaran', 'saldo'], 'integer'],
            [['waktu', 'last_waktu_update', 'deleted_at'], 'safe'],
            [['is_deleted'], 'boolean'],
            [['kanal_transaksi'], 'string', 'max' => 20],
            [['kode_toko', 'kanal_transaksi', 'nomor_pesanan'], 'unique', 'targetAttribute' => ['kode_toko', 'kanal_transaksi', 'nomor_pesanan']],
            [['kode_toko', 'kanal_transaksi', 'nomor_referensi'], 'unique', 'targetAttribute' => ['kode_toko', 'kanal_transaksi', 'nomor_referensi']],
            [['mata_uang'], 'string', 'max' => 6],
            [['alamat','keterangan'], 'string', 'max' => 255],
            [['anggota_nomor_zahir', 'email', 'nama_pelanggan','nomor_hp', 'kurir', 'nomor_resi', 'insert_by', 'last_update_by', 'last_softdelete_by'], 'string', 'max' => 50],
            [['anggota_id'], 'exist', 'skipOnError' => true, 'targetClass' => Anggota::className(), 'targetAttribute' => ['anggota_id' => 'id']],
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
            'anggota_id' => 'Anggota ID',
            'anggota_nomor_zahir' => 'Anggota Nomor Zahir',
            'nama_pelanggan' => 'Nama Pelanggan',
            'nomor_hp' => 'Nomor HP',
            'email' => 'Email',
            'alamat' => 'Alamat',
            'kurir' => 'Kurir',
            'nomor_resi' => 'Nomor Resi',
            'mata_uang' => 'Mata Uang',
            'subtotal' => 'Subtotal',
            'diskon' => 'Diskon',
            'pajak' => 'Pajak',
            'total_penjualan' => 'Total Penjualan',
            'pembayaran' => 'Tunai',
            'saldo' => 'Hutang',
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
        $scenarios['backend-import-zahir'] = ['kode_toko','kanal_transaksi','nomor_referensi','nomor_pesanan','anggota_nomor_zahir','nama_pelanggan','mata_uang','subtotal','diskon','pajak','total_penjualan','pembayaran','saldo'];
        return $scenarios;
    }

    /**
     * Gets query for [[Anggota]].
     *
     * @return \yii\db\ActiveQuery|AnggotaQuery
     */
    public function getAnggotaById()
    {
        return $this->hasOne(Anggota::className(), ['id' => 'anggota_id']);
    }

    public function getAnggotaByNoZahir()
    {
        return $this->hasOne(Anggota::className(), ['nomor_zahir' => 'anggota_nomor_zahir']);
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
     * @return TransaksiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TransaksiQuery(get_called_class());
    }

    public static function findTransaksi()
    {
        return self::find()
            ->where(['kode_toko'=>Yii::$app->user->identity->kode_toko]);
    }

    public static function findOneTransaksi($id)
    {
        return self::findTransaksi()
            ->andWhere(['id'=>$id])
            ->one();
    }

    public static function findTransaksiByKanal($kanal_transaksi,$nomor_referensi)
    {
        return self::findTransaksi()
            ->andWhere(['kanal_transaksi'=>$kanal_transaksi])
            ->andWhere(['nomor_referensi'=>$nomor_referensi]);
    }

    public static function findFrontendTransaksi()
    {
        return self::find()
        ->where(['kode_toko'=>Yii::$app->params['kode_toko']])
        ->andWhere(['anggota_id'=>Yii::$app->user->identity->id]);
    }

    public static function findOneFrontendTransaksi($id)
    {
        return self::findFrontendTransaksi()
        ->andWhere(['id'=>$id])
        ->one();
    }
}
