<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "variabel_pendidikanterakhir".
 *
 * @property string $pendidikanterakhir
 *
 * @property Anggota[] $anggota
 */
class VariabelPendidikanterakhir extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'variabel_pendidikanterakhir';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pendidikanterakhir'], 'required'],
            [['pendidikanterakhir'], 'string', 'max' => 20],
            [['pendidikanterakhir'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pendidikanterakhir' => 'Pendidikanterakhir',
        ];
    }

    /**
     * Gets query for [[Anggota]].
     *
     * @return \yii\db\ActiveQuery|AnggotaQuery
     */
    public function getAnggota()
    {
        return $this->hasMany(Anggota::className(), ['pendidikanterakhir' => 'pendidikanterakhir']);
    }

    /**
     * {@inheritdoc}
     * @return VariabelPendidikanterakhirQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VariabelPendidikanterakhirQuery(get_called_class());
    }
}
