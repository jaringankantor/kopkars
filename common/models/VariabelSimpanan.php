<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "variabel_simpanan".
 *
 * @property string $simpanan
 *
 * @property AnggotaSimpanan[] $anggotaSimpanans
 */
class VariabelSimpanan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'variabel_simpanan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['simpanan'], 'required'],
            [['simpanan'], 'string', 'max' => 20],
            [['simpanan'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'simpanan' => 'Simpanan',
        ];
    }

    /**
     * Gets query for [[AnggotaSimpanans]].
     *
     * @return \yii\db\ActiveQuery|AnggotaSimpananQuery
     */
    public function getAnggotaSimpanans()
    {
        return $this->hasMany(AnggotaSimpanan::className(), ['simpanan' => 'simpanan']);
    }

    /**
     * {@inheritdoc}
     * @return VariabelSimpananQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VariabelSimpananQuery(get_called_class());
    }
}
