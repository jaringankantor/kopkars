<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "variabel_agama".
 *
 * @property string $agama
 *
 * @property Anggota[] $anggota
 */
class VariabelAgama extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'variabel_agama';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['agama'], 'required'],
            [['agama'], 'string', 'max' => 20],
            [['agama'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'agama' => 'Agama',
        ];
    }

    /**
     * Gets query for [[Anggota]].
     *
     * @return \yii\db\ActiveQuery|AnggotaQuery
     */
    public function getAnggota()
    {
        return $this->hasMany(Anggota::className(), ['agama' => 'agama']);
    }

    /**
     * {@inheritdoc}
     * @return VariabelAgamaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VariabelAgamaQuery(get_called_class());
    }
}
