<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "toko".
 *
 * @property string $kode
 * @property string $nama_toko
 * @property string|null $skuprefix1
 * @property string|null $skuprefix2
 * @property string|null $skuprefix3
 * @property string|null $skuprefix4
 * @property string|null $skuprefix5
 * @property string|null $skuprefix6
 * @property string|null $skuprefix7
 * @property string|null $skuprefix8
 * @property string|null $skuprefix9
 * @property string|null $skuprefix10
 *
 * @property Produk[] $produks
 * @property SettingMarketplace[] $settingMarketplaces
 * @property SettingMarketplaceEtalase[] $settingMarketplaceEtalases
 * @property SettingMarketplaceKategori[] $settingMarketplaceKategoris
 * @property User[] $users
 * @property VariabelMarketplace[] $variabelMarketplaces
 * @property VariabelMarketplaceEtalase[] $variabelMarketplaceEtalases
 * @property VariabelMarketplaceKategori[] $variabelMarketplaceKategoris
 */
class Toko extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'toko';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'nama_toko'], 'required'],
            ['kode', 'match' ,'pattern'=>'/^[A-Za-z0-9._-]+$/u','message'=> 'Only alphanumeric, dot(.), underscore(_), and hypen(-)'], 
            [['kode', 'nama_toko'], 'string', 'max' => 50],
            [['skuprefix1', 'skuprefix2', 'skuprefix3', 'skuprefix4', 'skuprefix5', 'skuprefix6', 'skuprefix7', 'skuprefix8', 'skuprefix9', 'skuprefix10'], 'string', 'length' => 5],
            [['kode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode' => 'Kode',
            'nama_toko' => 'Nama Toko',
            'skuprefix1' => 'SKU Prefix1',
            'skuprefix2' => 'SKU Prefix2',
            'skuprefix3' => 'SKU Prefix3',
            'skuprefix4' => 'SKU Prefix4',
            'skuprefix5' => 'SKU Prefix5',
            'skuprefix6' => 'SKU Prefix6',
            'skuprefix7' => 'SKU Prefix7',
            'skuprefix8' => 'SKU Prefix8',
            'skuprefix9' => 'SKU Prefix9',
            'skuprefix10' => 'SKU Prefix10',
        ];
    }

    /**
     * Gets query for [[Produks]].
     *
     * @return \yii\db\ActiveQuery|ProdukQuery
     */
    public function getProduks()
    {
        return $this->hasMany(Produk::className(), ['kode_toko' => 'kode']);
    }

    /**
     * Gets query for [[SettingMarketplaces]].
     *
     * @return \yii\db\ActiveQuery|SettingMarketplaceQuery
     */
    public function getSettingMarketplaces()
    {
        return $this->hasMany(SettingMarketplace::className(), ['kode_toko' => 'kode']);
    }

    /**
     * Gets query for [[SettingMarketplaceEtalases]].
     *
     * @return \yii\db\ActiveQuery|SettingMarketplaceEtalaseQuery
     */
    public function getSettingMarketplaceEtalases()
    {
        return $this->hasMany(SettingMarketplaceEtalase::className(), ['kode_toko' => 'kode']);
    }

    /**
     * Gets query for [[SettingMarketplaceKategoris]].
     *
     * @return \yii\db\ActiveQuery|SettingMarketplaceKategoriQuery
     */
    public function getSettingMarketplaceKategoris()
    {
        return $this->hasMany(SettingMarketplaceKategori::className(), ['kode_toko' => 'kode']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['kode_toko' => 'kode']);
    }

    /**
     * Gets query for [[VariabelMarketplaces]].
     *
     * @return \yii\db\ActiveQuery|VariabelMarketplaceQuery
     */
    public function getVariabelMarketplaces()
    {
        return $this->hasMany(VariabelMarketplace::className(), ['kode_toko' => 'kode']);
    }

    /**
     * Gets query for [[VariabelMarketplaceEtalases]].
     *
     * @return \yii\db\ActiveQuery|VariabelMarketplaceEtalaseQuery
     */
    public function getVariabelMarketplaceEtalases()
    {
        return $this->hasMany(VariabelMarketplaceEtalase::className(), ['kode_toko' => 'kode']);
    }

    /**
     * Gets query for [[VariabelMarketplaceKategoris]].
     *
     * @return \yii\db\ActiveQuery|VariabelMarketplaceKategoriQuery
     */
    public function getVariabelMarketplaceKategoris()
    {
        return $this->hasMany(VariabelMarketplaceKategori::className(), ['kode_toko' => 'kode']);
    }

    /**
     * {@inheritdoc}
     * @return TokoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TokoQuery(get_called_class());
    }
}
