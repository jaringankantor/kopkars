<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "variabel_marketplace".
 *
 * @property string $kode
 * @property string $marketplace
 *
 * @property VariabelMarketplaceKategori[] $variabelMarketplaceKategoris
 */
class VariabelMarketplace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'variabel_marketplace';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_toko','kode', 'marketplace'], 'required'],
            ['kode_toko', 'string', 'max' => 50],
            ['kode_toko', 'match' ,'pattern'=>'/^[A-Za-z0-9._-]+$/u','message'=> 'Only alphanumeric, dot(.), underscore(_), and hypen(-)'],
            [['kode'], 'string', 'max' => 3],
            [['marketplace'], 'string', 'max' => 50],
            ['kode', 'unique', 'targetAttribute' => ['kode_toko', 'kode']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode_toko' => 'Kode Toko',
            'kode' => 'Kode',
            'marketplace' => 'Marketplace',
        ];
    }

    /**
     * Gets query for [[VariabelMarketplaceKategoris]].
     *
     * @return \yii\db\ActiveQuery|VariabelMarketplaceKategoriQuery
     */
    public function getVariabelMarketplaceKategoris()
    {
        return $this->hasMany(VariabelMarketplaceKategori::className(), ['kode_variabel_marketplace' => 'kode'])
        ->andOnCondition(['kode_toko'=>Yii::$app->user->identity->kode_toko]);
    }

    /**
     * {@inheritdoc}
     * @return VariabelMarketplaceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VariabelMarketplaceQuery(get_called_class());
    }

    public static function findOneVariabelMarketplace($kode)
    {
        return self::find()
            ->andWhere(['kode'=>$kode])
            ->one();
    }
}
