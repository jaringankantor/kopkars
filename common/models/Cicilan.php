<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "cicilan".
 *
 * @property int $id
 * @property string $kode_toko
 * @property int $anggota_id
 * @property string $kanal_cicilan
 * @property string|null $nomor_referensi
 * @property int $cicilan
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
 * @property VariabelKanalCicilan $kanalCicilan
 */
class Cicilan extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cicilan';
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
            [['kode_toko', 'anggota_id', 'kanal_cicilan', 'cicilan'], 'required'],
            [['anggota_id', 'cicilan'], 'default', 'value' => null],
            [['anggota_id', 'cicilan'], 'integer'],
            [['waktu', 'last_waktu_update', 'deleted_at'], 'safe'],
            [['is_deleted'], 'boolean'],
            [['kode_toko', 'nomor_referensi', 'insert_by', 'last_update_by', 'last_softdelete_by'], 'string', 'max' => 50],
            [['kanal_cicilan'], 'string', 'max' => 20],
            [['keterangan'], 'string', 'max' => 255],
            [['anggota_id'], 'exist', 'skipOnError' => true, 'targetClass' => Anggota::className(), 'targetAttribute' => ['anggota_id' => 'id']],
            [['kode_toko'], 'exist', 'skipOnError' => true, 'targetClass' => Toko::className(), 'targetAttribute' => ['kode_toko' => 'kode']],
            [['kanal_cicilan'], 'exist', 'skipOnError' => true, 'targetClass' => VariabelKanalCicilan::className(), 'targetAttribute' => ['kanal_cicilan' => 'kanal_cicilan']],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['default'] = [];
        $scenarios['backend-keterangan-cicilan'] = ['keterangan'];
        return $scenarios;
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
            'kanal_cicilan' => 'Kanal Cicilan',
            'nomor_referensi' => 'Nomor Referensi',
            'cicilan' => 'Cicilan',
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
     * Gets query for [[KanalCicilan]].
     *
     * @return \yii\db\ActiveQuery|VariabelKanalCicilanQuery
     */
    public function getKanalCicilan()
    {
        return $this->hasOne(VariabelKanalCicilan::className(), ['kanal_cicilan' => 'kanal_cicilan']);
    }

    /**
     * {@inheritdoc}
     * @return CicilanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CicilanQuery(get_called_class());
    }

    public static function findCicilan()
    {
        return self::find()
            ->where(['kode_toko'=>Yii::$app->user->identity->kode_toko])
            ->orderBy(['waktu' => SORT_DESC]);
    }

    public static function findOneCicilan($id)
    {
        return self::findCicilan()
            ->andWhere(['id'=>$id])
            ->one();
    }

    public static function findFrontendCicilan()
    {
        return self::find()
            ->where(['kode_toko'=>Yii::$app->params['kode_toko']])
            ->andWhere(['anggota_id'=>Yii::$app->user->identity->id])
            ->orderBy(['waktu' => SORT_DESC]);
    }

    public static function findOneFrontendCicilan($id)
    {
        return self::findFrontendCicilan()
            ->andWhere(['id'=>$id])
            ->one();
    }
}
