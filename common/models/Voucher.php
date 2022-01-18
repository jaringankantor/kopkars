<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "voucher".
 *
 * @property string $kode_voucher
 * @property string $nama_voucher
 * @property string $kode_toko
 * @property int $anggota_id
 * @property int $rupiah
 * @property int $rupiah_terpakai
 * @property string $berlaku_mulai
 * @property string $berakhir_sampai
 * @property string|null $keterangan
 * @property string $waktu
 * @property string|null $last_waktu_update
 * @property string|null $insert_by
 * @property string|null $last_update_by
 * @property bool|null $is_deleted
 * @property string|null $deleted_at
 * @property string|null $last_softdelete_by
 *
 * @property Anggota $anggota
 * @property Toko $kodeToko
 */
class Voucher extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'voucher';
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

    public function beforeSoftDelete()
    {
        $this->deleted_at = date('Y-m-d H:i:s');
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['kode_toko', 'match' ,'pattern'=>'/^[A-Za-z0-9._-]+$/u','message'=> 'Only alphanumeric, dot(.), underscore(_), and hypen(-)'],
            [['kode_voucher', 'nama_voucher', 'kode_toko', 'anggota_id', 'rupiah', 'berakhir_sampai'], 'required'],
            [['anggota_id', 'rupiah', 'rupiah_terpakai'], 'default', 'value' => null],
            [['anggota_id', 'rupiah', 'rupiah_terpakai'], 'integer'],
            [['berlaku_mulai', 'berakhir_sampai', 'waktu', 'last_waktu_update', 'deleted_at'], 'safe'],
            [['is_deleted'], 'boolean'],
            [['kode_voucher'], 'string', 'max' => 10],
            [['nama_voucher'], 'string', 'max' => 20],
            [['kode_toko', 'insert_by', 'last_update_by', 'last_softdelete_by'], 'string', 'max' => 50],
            [['keterangan'], 'string', 'max' => 255],
            [['kode_voucher', 'kode_toko'], 'unique', 'targetAttribute' => ['kode_voucher', 'kode_toko']],
            [['anggota_id'], 'exist', 'skipOnError' => true, 'targetClass' => Anggota::className(), 'targetAttribute' => ['anggota_id' => 'id']],
            [['kode_toko'], 'exist', 'skipOnError' => true, 'targetClass' => Toko::className(), 'targetAttribute' => ['kode_toko' => 'kode']],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['default'] = [];
        $scenarios['backend-gunakan-voucher'] = ['rupiah_terpakai', 'last_update_by'];
        $scenarios['backend-keterangan-voucher'] = ['keterangan'];
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode_voucher' => 'Kode Voucher',
            'nama_voucher' => 'Nama Voucher',
            'kode_toko' => 'Kode Toko',
            'anggota_id' => 'Anggota ID',
            'rupiah' => 'Rupiah',
            'rupiah_terpakai' => 'Rupiah Terpakai',
            'berlaku_mulai' => 'Berlaku Mulai',
            'berakhir_sampai' => 'Berakhir Sampai',
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
     * {@inheritdoc}
     * @return VoucherQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VoucherQuery(get_called_class());
    }

    public static function findVoucher()
    {
        return self::find()
            ->where(['kode_toko'=>Yii::$app->user->identity->kode_toko])
            ->orderBy(['waktu' => SORT_DESC]);
    }

    public static function findOneVoucher($kode_voucher,$kode_toko)
    {
        return self::findVoucher()
            ->Where(['kode_voucher'=>$kode_voucher])
            ->one();
    }

    public static function findFrontendVoucher()
    {
        return self::find()
            ->where(['kode_toko'=>Yii::$app->params['kode_toko']])
            ->andWhere(['anggota_id'=>Yii::$app->user->identity->id])
            ->orderBy(['waktu' => SORT_DESC]);
    }

    public static function findOneFrontendVoucher($kode_voucher)
    {
        return self::findFrontendVoucher()
            ->andWhere(['kode_voucher'=>$kode_voucher])
            ->one();
    }
}
