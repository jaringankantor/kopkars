<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "setting_marketplace".
 *
 * @property string $kode_toko
 * @property string $kode_variabel_marketplace
 * @property string|null $bli_kodetokogudang
 * @property string|null $shp_idtoko
 * @property int|null $lzd_minimum_price
 * @property bool $ekspedisi_alfatrex_nextday
 * @property bool $ekspedisi_alfatrex_reg
 * @property bool $ekspedisi_anteraja
 * @property bool $ekspedisi_grabexpress_instant
 * @property bool $ekspedisi_grabexpress_rush_delivery
 * @property bool $ekspedisi_grabexpress_sameday
 * @property bool $ekspedisi_gosend_instant
 * @property bool $ekspedisi_gosend_sameday
 * @property bool $ekspedisi_hemat
 * @property bool $ekspedisi_instant
 * @property bool $ekspedisi_jne_jtr_cashless
 * @property bool $ekspedisi_jne_reg
 * @property bool $ekspedisi_jne_reg_cashless
 * @property bool $ekspedisi_jne_trucking
 * @property bool $ekspedisi_jne_yes
 * @property bool $ekspedisi_jne_yes_cashless
 * @property bool $ekspedisi_jnt_economy
 * @property bool $ekspedisi_jnt_ekspress
 * @property bool $ekspedisi_jnt_jemari
 * @property bool $ekspedisi_jnt_reg
 * @property bool $ekspedisi_jnt_trucking
 * @property bool $ekspedisi_kargo
 * @property bool $ekspedisi_lionparcel_onepack
 * @property bool $ekspedisi_lionparcel_regpack
 * @property bool $ekspedisi_nextday
 * @property bool $ekspedisi_ninja_fast
 * @property bool $ekspedisi_ninja_reg
 * @property bool $ekspedisi_ninja_xpress
 * @property bool $ekspedisi_paxel_sameday
 * @property bool $ekspedisi_pelapak
 * @property bool $ekspedisi_pickup
 * @property bool $ekspedisi_pos_kilat_khusus
 * @property bool $ekspedisi_pos_nextday
 * @property bool $ekspedisi_reguler_cashless
 * @property bool $ekspedisi_rpx_economy
 * @property bool $ekspedisi_rpx_nextday
 * @property bool $ekspedisi_sameday
 * @property bool $ekspedisi_shopee_express_instant
 * @property bool $ekspedisi_shopee_express_standard
 * @property bool $ekspedisi_sicepat_best
 * @property bool $ekspedisi_sicepat_halu
 * @property bool $ekspedisi_sicepat_reg
 * @property bool $ekspedisi_tiki_ons
 * @property bool $ekspedisi_tiki_reg
 * @property bool $ekspedisi_wahana
 * @property string|null $shp_idtoko 
 * @property string|null $url_toko 
 * @property string|null $header_produk 
 * @property string|null $footer_produk 
 *
 * @property VariabelMarketplace $kodeVariabelMarketplace
 * @property Toko $kodeToko
 */
class SettingMarketplace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'setting_marketplace';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_toko','kode_variabel_marketplace'], 'required'],
            ['kode_toko', 'string', 'max' => 50],
            ['kode_toko', 'match' ,'pattern'=>'/^[A-Za-z0-9._-]+$/u','message'=> 'Only alphanumeric, dot(.), underscore(_), and hypen(-)'],
            [['lzd_minimum_price'], 'default', 'value' => null],
            [['lzd_minimum_price'], 'integer'],
            [['ekspedisi_alfatrex_nextday', 'ekspedisi_alfatrex_reg', 'ekspedisi_anteraja', 'ekspedisi_grabexpress_instant', 'ekspedisi_grabexpress_rush_delivery', 'ekspedisi_grabexpress_sameday', 'ekspedisi_gosend_instant', 'ekspedisi_gosend_sameday', 'ekspedisi_jne_jtr_cashless', 'ekspedisi_jne_reg', 'ekspedisi_jne_reg_cashless', 'ekspedisi_jne_trucking', 'ekspedisi_jne_yes', 'ekspedisi_jne_yes_cashless', 'ekspedisi_jnt_economy', 'ekspedisi_jnt_ekspress', 'ekspedisi_jnt_jemari', 'ekspedisi_jnt_reg', 'ekspedisi_lionparcel_onepack', 'ekspedisi_lionparcel_regpack', 'ekspedisi_ninja_fast', 'ekspedisi_ninja_reg', 'ekspedisi_ninja_xpress', 'ekspedisi_paxel_sameday', 'ekspedisi_pelapak', 'ekspedisi_pickup', 'ekspedisi_pos_kilat_khusus', 'ekspedisi_pos_nextday', 'ekspedisi_rpx_economy', 'ekspedisi_rpx_nextday', 'ekspedisi_shopee_express_instant', 'ekspedisi_shopee_express_standard', 'ekspedisi_sicepat_best', 'ekspedisi_sicepat_halu', 'ekspedisi_sicepat_reg', 'ekspedisi_tiki_ons', 'ekspedisi_tiki_reg', 'ekspedisi_wahana','ekspedisi_jnt_trucking','ekspedisi_reguler_cashless','ekspedisi_hemat','ekspedisi_kargo','ekspedisi_sameday','ekspedisi_instant','ekspedisi_nextday'], 'boolean'],
            [['kode_variabel_marketplace'], 'string', 'max' => 3],
            [['bli_kodetokogudang','shp_idtoko','url_toko'], 'string', 'max' => 255],
            [['header_produk', 'footer_produk'], 'string'], 
            ['kode_variabel_marketplace', 'unique', 'targetAttribute' => ['kode_toko', 'kode_variabel_marketplace']],
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
            'bli_kodetokogudang' => 'Kode Gudang Toko',
            'shp_idtoko' => 'ID Toko',
            'url_toko' => 'URL Toko', 
            'header_produk' => 'Header Tiap Produk', 
            'footer_produk' => 'Footer Tiap Produk', 
            'lzd_minimum_price' => 'Lzd Minimum Price',
            'ekspedisi_alfatrex_nextday' => 'Ekspedisi Alfatrex Nextday',
            'ekspedisi_alfatrex_reg' => 'Ekspedisi Alfatrex Reg',
            'ekspedisi_anteraja' => 'Ekspedisi Anteraja',
            'ekspedisi_grabexpress_instant' => 'Ekspedisi Grabexpress Instant',
            'ekspedisi_grabexpress_rush_delivery' => 'Ekspedisi Grabexpress Rush Delivery',
            'ekspedisi_grabexpress_sameday' => 'Ekspedisi Grabexpress Sameday',
            'ekspedisi_gosend_instant' => 'Ekspedisi Gosend Instant',
            'ekspedisi_gosend_sameday' => 'Ekspedisi Gosend Sameday',
            'ekspedisi_jne_jtr_cashless' => 'Ekspedisi Jne Jtr Cashless',
            'ekspedisi_jne_reg' => 'Ekspedisi Jne Reg',
            'ekspedisi_jne_reg_cashless' => 'Ekspedisi Jne Reg Cashless',
            'ekspedisi_jne_trucking' => 'Ekspedisi Jne Trucking',
            'ekspedisi_jne_yes' => 'Ekspedisi Jne Yes',
            'ekspedisi_jne_yes_cashless' => 'Ekspedisi Jne Yes Cashless',
            'ekspedisi_jnt_economy' => 'Ekspedisi Jnt Economy',
            'ekspedisi_jnt_ekspress' => 'Ekspedisi Jnt Ekspress',
            'ekspedisi_jnt_jemari' => 'Ekspedisi Jnt Jemari',
            'ekspedisi_jnt_reg' => 'Ekspedisi Jnt Reg',
            'ekspedisi_lionparcel_onepack' => 'Ekspedisi Lionparcel Onepack',
            'ekspedisi_lionparcel_regpack' => 'Ekspedisi Lionparcel Regpack',
            'ekspedisi_ninja_fast' => 'Ekspedisi Ninja Fast',
            'ekspedisi_ninja_reg' => 'Ekspedisi Ninja Reg',
            'ekspedisi_ninja_xpress' => 'Ekspedisi Ninja Xpress',
            'ekspedisi_paxel_sameday' => 'Ekspedisi Paxel Sameday',
            'ekspedisi_pelapak' => 'Ekspedisi Pelapak',
            'ekspedisi_pickup' => 'Ekspedisi Pickup',
            'ekspedisi_pos_kilat_khusus' => 'Ekspedisi Pos Kilat Khusus',
            'ekspedisi_pos_nextday' => 'Ekspedisi Pos Nextday',
            'ekspedisi_rpx_economy' => 'Ekspedisi Rpx Economy',
            'ekspedisi_rpx_nextday' => 'Ekspedisi Rpx Nextday',
            'ekspedisi_shopee_express_instant' => 'Ekspedisi Shopee Express Instant',
            'ekspedisi_shopee_express_standard' => 'Ekspedisi Shopee Express Standard',
            'ekspedisi_sicepat_best' => 'Ekspedisi Sicepat Best',
            'ekspedisi_sicepat_halu' => 'Ekspedisi Sicepat Halu',
            'ekspedisi_sicepat_reg' => 'Ekspedisi Sicepat Reg',
            'ekspedisi_tiki_ons' => 'Ekspedisi Tiki Ons',
            'ekspedisi_tiki_reg' => 'Ekspedisi Tiki Reg',
            'ekspedisi_wahana' => 'Ekspedisi Wahana',
            'ekspedisi_jnt_trucking' => 'Ekspedisi JNT Trucking',
            'ekspedisi_reguler_cashless' => 'Ekspedisi Reguler (Cahsless)',
            'ekspedisi_hemat' => 'Ekspedisi Hemat',
            'ekspedisi_kargo' => 'Ekspedisi Kargo',
            'ekspedisi_sameday' => 'Ekspedisi Sameday',
            'ekspedisi_instant' => 'Ekspedisi Instant',
            'ekspedisi_nextday' => 'Ekspedisi Nextday'
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
     * @return SettingMarketplaceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SettingMarketplaceQuery(get_called_class());
    }

    public static function parameter($kode_variabel_marketplace)
    {
        return self::find()
            ->where(['kode_variabel_marketplace'=>$kode_variabel_marketplace,'kode_toko'=>Yii::$app->user->identity->kode_toko])
            ->one();
    }
}
