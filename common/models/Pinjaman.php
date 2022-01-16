<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "pinjaman".
 *
 * @property int $id
 * @property string $kode_toko
 * @property int $anggota_id
 * @property int $saldo_pokok
 * @property int $saldo_jasa
 * @property int $total_pembayaran
 * @property string|null $mulai_tanggal_pembayaran
 * @property string|null $rencana_tanggal_pelunasan
 * @property string|null $aktual_tanggal_pelunasan
 * @property string|null $peruntukan
 * @property string|null $keterangan
 * @property string $waktu
 * @property string|null $last_waktu_update
 * @property string|null $insert_by
 * @property string|null $last_update_by
 * @property bool|null $is_deleted
 * @property string|null $deleted_at
 * @property string|null $last_softdelete_by
 * @property string|null $nomor_referensi
 *
 * @property Anggota $anggota
 * @property Toko $kodeToko
 */
class Pinjaman extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pinjaman';
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
            [['kode_toko', 'anggota_id', 'saldo_pokok', 'saldo_jasa'], 'required'],
            ['kode_toko', 'match' ,'pattern'=>'/^[A-Za-z0-9._-]+$/u','message'=> 'Only alphanumeric, dot(.), underscore(_), and hypen(-)'],
            [['anggota_id', 'saldo_pokok', 'saldo_jasa', 'total_pembayaran'], 'default', 'value' => null],
            [['anggota_id', 'saldo_pokok', 'saldo_jasa', 'total_pembayaran'], 'integer'],
            [['mulai_tanggal_pembayaran', 'rencana_tanggal_pelunasan', 'aktual_tanggal_pelunasan', 'waktu', 'last_waktu_update', 'deleted_at'], 'safe'],
            [['is_deleted'], 'boolean'],
            [['kode_toko', 'insert_by', 'last_update_by', 'last_softdelete_by', 'nomor_referensi'], 'string', 'max' => 50],
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
            'saldo_pokok' => 'Pokok Pinjaman',
            'saldo_jasa' => 'Jasa Pinjaman',
            'total_pembayaran' => 'Total Pinjaman',
            'mulai_tanggal_pembayaran' => 'Mulai Tanggal Pembayaran',
            'rencana_tanggal_pelunasan' => 'Rencana Tanggal Pelunasan',
            'aktual_tanggal_pelunasan' => 'Aktual Tanggal Pelunasan',
            'peruntukan' => 'Peruntukan',
            'keterangan' => 'Keterangan',
            'waktu' => 'Waktu',
            'last_waktu_update' => 'Last Waktu Update',
            'insert_by' => 'Insert By',
            'last_update_by' => 'Last Update By',
            'is_deleted' => 'Is Deleted',
            'deleted_at' => 'Deleted At',
            'last_softdelete_by' => 'Last Softdelete By',
            'nomor_referensi' => 'Nomor Referensi',
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
     * @return PinjamanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PinjamanQuery(get_called_class());
    }

    public static function findPinjaman()
    {
        return self::find()
            ->where(['kode_toko'=>Yii::$app->user->identity->kode_toko])
            ->orderBy(['waktu' => SORT_DESC]);
    }

    public static function findOnePinjaman($id)
    {
        return self::findPinjaman()
            ->andWhere(['id'=>$id])
            ->one();
    }

    public static function findFrontendPinjaman()
    {
        return self::find()
            ->where(['kode_toko'=>Yii::$app->params['kode_toko']])
            ->andWhere(['anggota_id'=>Yii::$app->user->identity->id])
            ->orderBy(['waktu' => SORT_DESC]);
    }

    public static function findOneFrontendPinjaman($id)
    {
        return self::findFrontendPinjaman()
            ->andWhere(['id'=>$id])
            ->one();
    }
}
