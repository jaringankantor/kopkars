<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "variabel_marketplace_etalase".
 *
 * @property string $kode_variabel_marketplace
 * @property string $kode
 * @property string $marketplace_etalase
 *
 * @property VariabelMarketplace $kodeVariabelMarketplace
 */
class VariabelMarketplaceEtalase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'variabel_marketplace_etalase';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_toko','kode_variabel_marketplace', 'kode', 'marketplace_etalase'], 'required'],
            ['kode_toko', 'string', 'max' => 50],
            ['kode_toko', 'match' ,'pattern'=>'/^[A-Za-z0-9._-]+$/u','message'=> 'Only alphanumeric, dot(.), underscore(_), and hypen(-)'],
            [['kode_variabel_marketplace'], 'string', 'max' => 3],
            [['kode'], 'string', 'max' => 50],
            [['marketplace_etalase'], 'string', 'max' => 255],
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
            'marketplace_etalase' => 'Marketplace Etalase',
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
     * @return VariabelMarketplaceEtalaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VariabelMarketplaceEtalaseQuery(get_called_class());
    }

    public static function findVariabelMarketplaceEtalase()
    {
        return self::find()
            ->where(['kode_toko'=>Yii::$app->user->identity->kode_toko]);
    }

    public static function findOneVariabelMarketplaceEtalase($kode_variabel_marketplace, $kode)
    {
        return self::findVariabelMarketplaceEtalase()
            ->andWhere(['kode_variabel_marketplace' => $kode_variabel_marketplace, 'kode' => $kode])
            ->one();
    }
}
