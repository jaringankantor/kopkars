<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "variabel_marketplace_kategori".
 *
 * @property string $kode_variabel_marketplace
 * @property string $kode
 * @property string $marketplace_kategori
 *
 * @property VariabelMarketplace $kodeVariabelMarketplace
 */
class VariabelMarketplaceKategori extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'variabel_marketplace_kategori';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_toko','kode_variabel_marketplace', 'kode', 'marketplace_kategori'], 'required'],
            ['kode_toko', 'string', 'max' => 50],
            ['kode_toko', 'match' ,'pattern'=>'/^[A-Za-z0-9._-]+$/u','message'=> 'Only alphanumeric, dot(.), underscore(_), and hypen(-)'],
            [['kode_variabel_marketplace'], 'string', 'max' => 3],
            [['kode'], 'string', 'max' => 150],
            [['marketplace_kategori'], 'string', 'max' => 255],
            [['kode_variabel_marketplace', 'kode'], 'unique', 'targetAttribute' => ['kode_toko', 'kode_variabel_marketplace', 'kode']],
            [['kode_variabel_marketplace'], 'exist', 'skipOnError' => true, 'targetClass' => VariabelMarketplace::className(), 'targetAttribute' => ['kode_variabel_marketplace' => 'kode']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode_toko' => 'Kode Toko',
            'kode_variabel_marketplace' => 'Kode Variabel Marketplace',
            'kode' => 'Kode',
            'marketplace_kategori' => 'Marketplace Kategori',
        ];
    }

    /**
     * Gets query for [[KodeVariabelMarketplace]].
     *
     * @return \yii\db\ActiveQuery|VariabelMarketplaceQuery
     */
    public function getKodeVariabelMarketplace()
    {
        return $this->hasOne(VariabelMarketplace::className(), ['kode' => 'kode_variabel_marketplace'])
        ->andOnCondition(['kode_toko'=>Yii::$app->user->identity->kode_toko]);
    }

    /**
     * {@inheritdoc}
     * @return VariabelMarketplaceKategoriQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VariabelMarketplaceKategoriQuery(get_called_class());
    }

    public static function findVariabelMarketplaceKategori()
    {
        return self::find()
            ->where(['kode_toko'=>Yii::$app->user->identity->kode_toko]);
    }
    public static function findMarketplaceKategori($kode_variabel_marketplace)
    {
        return self::findVariabelMarketplaceKategori()
            ->andWhere(['kode_variabel_marketplace'=>$kode_variabel_marketplace]);
    }

    public static function findOneVariabelMarketplaceKategori($kode_variabel_marketplace, $kode)
    {
        return self::findMarketplaceKategori($kode_variabel_marketplace)
            ->andWhere(['kode' => $kode])
            ->one();
    }
}
