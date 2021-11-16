<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "histori_anggota_status".
 *
 * @property int $id
 * @property int|null $anggota_id
 * @property string|null $anggota_status
 * @property string $waktu_update
 *
 * @property Anggota $anggota
 */
class HistoriAnggotaStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'histori_anggota_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['anggota_id'], 'default', 'value' => null],
            [['anggota_id'], 'integer'],
            [['waktu_update'], 'safe'],
            [['anggota_status'], 'string', 'max' => 20],
            [['anggota_id'], 'exist', 'skipOnError' => true, 'targetClass' => Anggota::className(), 'targetAttribute' => ['anggota_id' => 'id']],
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
            'anggota_status' => 'Anggota Status',
            'waktu_update' => 'Waktu Update',
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
     * {@inheritdoc}
     * @return HistoriAnggotaStatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HistoriAnggotaStatusQuery(get_called_class());
    }
}
