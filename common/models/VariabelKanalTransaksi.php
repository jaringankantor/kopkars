<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "variabel_kanal_transaksi".
 *
 * @property string $kanal_transaksi
 *
 * @property Transaksi[] $transaksis
 */
class VariabelKanalTransaksi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'variabel_kanal_transaksi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kanal_transaksi'], 'required'],
            [['kanal_transaksi'], 'string', 'max' => 20],
            [['kanal_transaksi'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kanal_transaksi' => 'Kanal Transaksi',
        ];
    }

    /**
     * Gets query for [[Transaksis]].
     *
     * @return \yii\db\ActiveQuery|TransaksiQuery
     */
    public function getTransaksis()
    {
        return $this->hasMany(Transaksi::className(), ['kanal_transaksi' => 'kanal_transaksi']);
    }

    /**
     * {@inheritdoc}
     * @return VariabelKanalTransaksiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VariabelKanalTransaksiQuery(get_called_class());
    }
}
