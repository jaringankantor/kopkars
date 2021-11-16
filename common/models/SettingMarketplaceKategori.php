<?php

namespace common\models;

use Yii;
use common\models\Produk;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "setting_marketplace_kategori".
 *
 * @property string $kode_variabel_marketplace
 * @property string $kode_variabel_marketplace_kategori
 * @property string $sku_produk
 *
 * @property Produk $skuProduk
 * @property VariabelMarketplace $kodeVariabelMarketplace
 */
class SettingMarketplaceKategori extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'setting_marketplace_kategori';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_toko','kode_variabel_marketplace', 'kode_variabel_marketplace_kategori', 'sku_produk'], 'required'],
            ['kode_toko', 'string', 'max' => 50],
            ['kode_toko', 'match' ,'pattern'=>'/^[A-Za-z0-9._-]+$/u','message'=> 'Only alphanumeric, dot(.), underscore(_), and hypen(-)'],
            [['kode_variabel_marketplace'], 'string', 'max' => 3],
            [['kode_variabel_marketplace_kategori'], 'string', 'max' => 150],
            [['sku_produk'], 'string', 'max' => 20],
            [['kode_variabel_marketplace', 'kode_variabel_marketplace_kategori', 'sku_produk'], 'unique', 'targetAttribute' => ['kode_toko','kode_variabel_marketplace', 'kode_variabel_marketplace_kategori', 'sku_produk']],
            [['sku_produk'], 'exist', 'skipOnError' => true, 'targetClass' => Produk::className(), 'targetAttribute' => ['sku_produk' => 'sku']],
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
            'kode_variabel_marketplace_kategori' => 'Kode Variabel Marketplace Kategori',
            'sku_produk' => 'SKU Produk',
        ];
    }

    /**
     * Gets query for [[SkuProduk]].
     *
     * @return \yii\db\ActiveQuery|ProdukQuery
     */
    public function getSkuProduk()
    {
        return $this->hasOne(Produk::className(), ['sku' => 'sku_produk'])
        ->andOnCondition(['kode_toko'=>Yii::$app->user->identity->kode_toko]);
    }

    public function getKodeVariabelMarketplaceKategori()
    {
        return $this->hasOne(VariabelMarketplaceKategori::className(), ['kode' => 'kode_variabel_marketplace_kategori'])
        ->andOnCondition(['kode_variabel_marketplace'=>$this->kode_variabel_marketplace])
        ->andOnCondition(['kode_toko'=>Yii::$app->user->identity->kode_toko]);
    }

    /**
     * Gets query for [[KodeVariabelMarketplace]].
     *
     * @return \yii\db\ActiveQuery|VariabelMarketplaceQuery
     */
    public function getKodeVariabelMarketplace()
    {
        return $this->hasOne(VariabelMarketplace::className(), ['kode' => 'kode_variabel_marketplace']);
    }

    /**
     * {@inheritdoc}
     * @return SettingMarketplaceKategoriQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SettingMarketplaceKategoriQuery(get_called_class());
    }

    public static function findSettingMarketplaceKategori()
    {
        return self::find()
            ->where(['kode_toko'=>Yii::$app->user->identity->kode_toko]);
    }

    public static function findMarketplaceKategori($kode_variabel_marketplace)
    {
        return self::findSettingMarketplaceKategori()
            ->andwhere(['kode_variabel_marketplace'=>$kode_variabel_marketplace]);
    }

    public static function findOneKategori($kode_variabel_marketplace,$sku_produk)
    {
        return self::findMarketplaceKategori($kode_variabel_marketplace)
            ->andWhere(['sku_produk'=>$sku_produk])
            ->one();
    }

    public static function findProdukDalamKategori($kode_variabel_marketplace,$kode_variabel_marketplace_kategori)
    {
        return self::findMarketplaceKategori($kode_variabel_marketplace)
            ->andWhere(['kode_variabel_marketplace_kategori'=>$kode_variabel_marketplace_kategori])
            ->orderBy(['sku_produk'=>SORT_DESC]);
    }

    public static function findOneProdukDalamKategori($kode_variabel_marketplace,$kode_variabel_marketplace_kategori,$sku_produk)
    {
        return self::findMarketplaceKategori($kode_variabel_marketplace)
            ->andWhere(['kode_variabel_marketplace_kategori'=>$kode_variabel_marketplace_kategori,'sku_produk'=>$sku_produk])
            ->orderBy(['sku_produk'=>SORT_DESC])
            ->one();
    }

    public static function findRequestPostPerKategori($kode_variabel_marketplace,$kode_variabel_marketplace_kategori,$sku_produk)
    {
        $list_sku = ArrayHelper::getColumn(
            self::findMarketplaceKategori($kode_variabel_marketplace)
            ->andWhere(['kode_variabel_marketplace_kategori'=>$kode_variabel_marketplace_kategori])
            ->andWhere(['in','sku_produk',$sku_produk])
            ->orderBy(['sku_produk' => SORT_ASC])->all(),'sku_produk'
        );

        return Produk::findRequestPost($list_sku);
    }
}
