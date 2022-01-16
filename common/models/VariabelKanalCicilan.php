<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "variabel_kanal_cicilan".
 *
 * @property string $kanal_cicilan
 *
 * @property Cicilan[] $cicilans
 */
class VariabelKanalCicilan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'variabel_kanal_cicilan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kanal_cicilan'], 'required'],
            [['kanal_cicilan'], 'string', 'max' => 20],
            [['kanal_cicilan'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kanal_cicilan' => 'Kanal Cicilan',
        ];
    }

    /**
     * Gets query for [[Cicilans]].
     *
     * @return \yii\db\ActiveQuery|CicilanQuery
     */
    public function getCicilans()
    {
        return $this->hasMany(Cicilan::className(), ['kanal_cicilan' => 'kanal_cicilan']);
    }

    /**
     * {@inheritdoc}
     * @return VariabelKanalCicilanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VariabelKanalCicilanQuery(get_called_class());
    }
}
