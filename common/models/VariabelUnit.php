<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "variabel_unit".
 *
 * @property string $unit
 *
 * @property Anggota[] $anggota
 */
class VariabelUnit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'variabel_unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unit'], 'required'],
            [['unit'], 'string', 'max' => 100],
            [['unit'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'unit' => 'Unit',
        ];
    }

    /**
     * Gets query for [[Anggota]].
     *
     * @return \yii\db\ActiveQuery|AnggotaQuery
     */
    public function getAnggota()
    {
        return $this->hasMany(Anggota::className(), ['unit' => 'unit']);
    }

    /**
     * {@inheritdoc}
     * @return VariabelUnitQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VariabelUnitQuery(get_called_class());
    }
}
