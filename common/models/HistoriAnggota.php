<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "histori_anggota".
 *
 * @property int $id
 * @property int|null $anggota_id
 * @property string|null $anggota_kolom
 * @property string|null $value_old
 * @property string|null $value_new
 * @property string $waktu_update
 */
class HistoriAnggota extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'histori_anggota';
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
            [['anggota_kolom'], 'string', 'max' => 50],
            [['value_old', 'value_new'], 'string', 'max' => 255],
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
            'anggota_kolom' => 'Anggota Kolom',
            'value_old' => 'Value Old',
            'value_new' => 'Value New',
            'waktu_update' => 'Waktu Update',
        ];
    }

    /**
     * {@inheritdoc}
     * @return HistoriAnggotaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HistoriAnggotaQuery(get_called_class());
    }
}
