<?php

namespace common\models;

use Yii;
use yii2tech\ar\softdelete\SoftDeleteBehavior;
use yii2tech\ar\softdelete\SoftDeleteQueryBehavior;

/**
 * This is the model class for table "anggota_simpanan".
 *
 * @property int $id
 * @property int $anggota_id
 * @property string $simpanan
 * @property string $debitkredit
 * @property int $rupiah
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
 * @property VariabelSimpanan $simpanan0
 */
class AnggotaSimpanan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'anggota_simpanan';
    }

    public function behaviors()
    {
        return [
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'is_deleted' => true
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
            [['anggota_id', 'simpanan', 'debitkredit', 'rupiah'], 'required'],
            [['anggota_id'], 'default', 'value' => null],
            [['anggota_id', 'rupiah'], 'integer'],
            [['waktu', 'last_waktu_update', 'deleted_at'], 'safe'],
            [['is_deleted'], 'boolean'],
            [['simpanan'], 'string', 'max' => 20],
            [['debitkredit'], 'string', 'max' => 6],
            [['keterangan'], 'string', 'max' => 255],
            [['insert_by', 'last_update_by', 'last_softdelete_by'], 'string', 'max' => 50],
            [['anggota_id'], 'exist', 'skipOnError' => true, 'targetClass' => Anggota::className(), 'targetAttribute' => ['anggota_id' => 'id']],
            [['simpanan'], 'exist', 'skipOnError' => true, 'targetClass' => VariabelSimpanan::className(), 'targetAttribute' => ['simpanan' => 'simpanan']],
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
            'simpanan' => 'Jenis Simpanan',
            'debitkredit' => 'Debit/Kredit',
            'rupiah' => 'Nominal Rupiah',
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
     * Gets query for [[Simpanan0]].
     *
     * @return \yii\db\ActiveQuery|VariabelSimpananQuery
     */
    public function getSimpanan0()
    {
        return $this->hasOne(VariabelSimpanan::className(), ['simpanan' => 'simpanan']);
    }

    /**
     * {@inheritdoc}
     * @return AnggotaSimpananQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AnggotaSimpananQuery(get_called_class());
    }

    public static function findAnggotaSimpanan()
    {
        return self::find()
            ->where(['anggota_id'=>Yii::$app->user->identity->id]);
    }
}
