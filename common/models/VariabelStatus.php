<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "variabel_status".
 *
 * @property string $status
 *
 * @property Anggota[] $anggota
 */
class VariabelStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'variabel_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['status'], 'string', 'max' => 20],
            [['status'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Anggota]].
     *
     * @return \yii\db\ActiveQuery|AnggotaQuery
     */
    public function getAnggota()
    {
        return $this->hasMany(Anggota::className(), ['status' => 'status']);
    }

    /**
     * {@inheritdoc}
     * @return VariabelStatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VariabelStatusQuery(get_called_class());
    }
}
