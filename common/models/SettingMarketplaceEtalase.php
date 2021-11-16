<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "setting_marketplace_etalase".
 *
 * @property string $kode_variabel_marketplace
 * @property string $kode_variabel_marketplace_etalase
 * @property string $sku_produk
 *
 * @property Produk $skuProduk
 * @property VariabelMarketplace $kodeVariabelMarketplace
 */
class SettingMarketplaceEtalase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'setting_marketplace_etalase';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_toko','kode_variabel_marketplace', 'kode_variabel_marketplace_etalase', 'sku_produk'], 'required'],
            ['kode_toko', 'string', 'max' => 50],
            ['kode_toko', 'match' ,'pattern'=>'/^[A-Za-z0-9._-]+$/u','message'=> 'Only alphanumeric, dot(.), underscore(_), and hypen(-)'],
            [['kode_variabel_marketplace'], 'string', 'max' => 3],
            [['kode_variabel_marketplace_etalase'], 'string', 'max' => 150],
            [['sku_produk'], 'string', 'max' => 20],
            [['kode_variabel_marketplace', 'kode_variabel_marketplace_etalase', 'sku_produk'], 'unique', 'targetAttribute' => ['kode_toko','kode_variabel_marketplace', 'kode_variabel_marketplace_etalase', 'sku_produk']],
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
            'kode_variabel_marketplace_etalase' => 'Kode Variabel Marketplace Etalase',
            'sku_produk' => 'Sku Produk',
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

    public function getKodeVariabelMarketplaceEtalase()
    {
        return $this->hasOne(VariabelMarketplaceEtalase::className(), ['kode' => 'kode_variabel_marketplace_etalase'])
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
     * @return SettingMarketplaceEtalaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SettingMarketplaceEtalaseQuery(get_called_class());
    }

    public static function findSettingMarketplaceEtalase()
    {
        return self::find()
            ->where(['kode_toko'=>Yii::$app->user->identity->kode_toko]);
    }

    public static function findMarketplaceEtalase($kode_variabel_marketplace)
    {
        return self::findSettingMarketplaceEtalase()
            ->andWhere(['kode_variabel_marketplace'=>$kode_variabel_marketplace]);
    }

    //belum tahu mungkin ngantuk
    public static function findOneEtalase($kode_variabel_marketplace,$sku_produk)
    {
        return self::findMarketplaceEtalase($kode_variabel_marketplace)
            ->andwhere(['sku_produk'=>$sku_produk,'kode_toko'=>Yii::$app->user->identity->kode_toko])
            ->one();
    }

    public static function findProdukDalamEtalase($kode_variabel_marketplace,$kode_variabel_marketplace_etalase)
    {
        return self::findMarketplaceEtalase($kode_variabel_marketplace)
            ->andWhere(['kode_variabel_marketplace_etalase'=>$kode_variabel_marketplace_etalase])
            ->orderBy(['sku_produk'=>SORT_DESC]);
    }

    public static function findOneProdukDalamEtalase($kode_variabel_marketplace,$kode_variabel_marketplace_etalase,$sku_produk)
    {
        return self::findMarketplaceEtalase($kode_variabel_marketplace)
            ->andWhere(['kode_variabel_marketplace_etalase'=>$kode_variabel_marketplace_etalase,'sku_produk'=>$sku_produk])
            ->orderBy(['sku_produk'=>SORT_DESC])
            ->one();
    }
}
