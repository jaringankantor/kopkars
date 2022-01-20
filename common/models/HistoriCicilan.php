<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "histori_cicilan".
 *
 * @property int $id
 * @property int $anggota_id
 * @property int $cicilan_id
 * @property string $cicilan_kolom
 * @property string $value_old
 * @property string|null $value_new
 * @property string $jenis_transaksi
 * @property string $waktu
 * @property string|null $by
 */
class HistoriCicilan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'histori_cicilan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['anggota_id', 'cicilan_id', 'cicilan_kolom', 'value_old', 'jenis_transaksi'], 'required'],
            [['anggota_id', 'cicilan_id'], 'default', 'value' => null],
            [['anggota_id', 'cicilan_id'], 'integer'],
            [['waktu'], 'safe'],
            [['cicilan_kolom', 'by'], 'string', 'max' => 50],
            [['value_old', 'value_new'], 'string', 'max' => 255],
            [['jenis_transaksi'], 'string', 'max' => 20],
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
            'cicilan_id' => 'Cicilan ID',
            'cicilan_kolom' => 'Cicilan Kolom',
            'value_old' => 'Value Old',
            'value_new' => 'Value New',
            'jenis_transaksi' => 'Jenis Transaksi',
            'waktu' => 'Waktu',
            'by' => 'By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return HistoriCicilanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HistoriCicilanQuery(get_called_class());
    }
}
