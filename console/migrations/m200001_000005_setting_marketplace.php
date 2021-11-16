<?php

use yii\db\Migration;
use yii\db\Schema;

class m200001_000005_setting_marketplace extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('setting_marketplace', [
            'kode_toko' => $this->string(50)->notNull(),
            'kode_variabel_marketplace'=> $this->string(3),
            'bli_kodetokogudang' => $this->string(),
            'shp_idtoko' => $this->string(),
            'url_toko' => $this->string(),
            'header_produk' => $this->string(),
            'footer_produk' => $this->string(),
            'lzd_minimum_price' => $this->integer(),
            'ekspedisi_alfatrex_nextday'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_alfatrex_reg'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_anteraja'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_grabexpress_instant'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_grabexpress_rush_delivery'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_grabexpress_sameday'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_gosend_instant'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_gosend_sameday'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_jne_jtr_cashless'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_jne_reg'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_jne_reg_cashless'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_jne_trucking'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_jne_yes'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_jne_yes_cashless'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_jnt_economy'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_jnt_ekspress'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_jnt_jemari'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_jnt_jemari'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_jnt_reg'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_lionparcel_onepack'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_lionparcel_regpack'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_ninja_fast'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_ninja_reg'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_ninja_xpress'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_paxel_sameday'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_pelapak'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_pickup'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_pos_kilat_khusus'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_pos_nextday'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_rpx_economy'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_rpx_nextday'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_shopee_express_instant'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_shopee_express_standard'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_sicepat_best'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_sicepat_halu'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_sicepat_reg'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_tiki_ons'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_tiki_reg'=> $this->boolean()->defaultValue(false)->notNull(),
            'ekspedisi_wahana'=> $this->boolean()->defaultValue(false)->notNull(),
        ]);

        $this->addPrimaryKey('setting_marketplace_pkey','setting_marketplace',array('kode_toko','kode_variabel_marketplace'));

        $this->addForeignKey('setting_marketplace_toko_fkey', 'setting_marketplace', 'kode_toko', 'toko', 'kode', 'RESTRICT', 'CASCADE');

        //sudah tidak berlaku karena ada kode_toko di reference tablenya
        //$this->addForeignKey('setting_marketplace_variabel_marketplace_fkey', 'setting_marketplace', 'kode_variabel_marketplace', 'variabel_marketplace', 'kode', 'RESTRICT', 'CASCADE');

        $this->batchInsert('setting_marketplace', ['kode_toko','kode_variabel_marketplace','url_toko','ekspedisi_jne_reg','ekspedisi_ninja_fast','ekspedisi_ninja_reg','ekspedisi_gosend_sameday',
        'ekspedisi_paxel_sameday','ekspedisi_grabexpress_instant','ekspedisi_pos_kilat_khusus','ekspedisi_jne_yes','ekspedisi_pos_nextday','ekspedisi_grabexpress_rush_delivery',
        'ekspedisi_sicepat_best','ekspedisi_sicepat_reg','ekspedisi_pelapak','ekspedisi_tiki_ons','ekspedisi_jne_trucking','ekspedisi_tiki_reg','ekspedisi_wahana',
        'ekspedisi_gosend_instant','ekspedisi_jnt_reg','ekspedisi_pickup','ekspedisi_grabexpress_sameday'],
        [
            ['hiiphooray-tani','bkl','https://www.bukalapak.com/hiiphooray_bibit',true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true],
        ]);
        
        $this->batchInsert('setting_marketplace', ['kode_toko','kode_variabel_marketplace','bli_kodetokogudang','url_toko'],
        [
            ['hiiphooray-tani','bli','PP-3158114','https://www.blibli.com/merchant/hiiphooray-tani/HIT-70006'],
        ]);

        $this->batchInsert('setting_marketplace', ['kode_toko','kode_variabel_marketplace','url_toko'],
        [
            ['hiiphooray-tani','elv','http://www.elevenia.co.id/store/hiiphooray-tani'],
        ]);

        $this->batchInsert('setting_marketplace', ['kode_toko','kode_variabel_marketplace','lzd_minimum_price','url_toko'],
        [
            ['hiiphooray-tani','lzd',3000,'https://www.lazada.co.id/hiiphooray-tani/'],
        ]);

        $this->batchInsert('setting_marketplace', ['kode_toko','kode_variabel_marketplace','shp_idtoko','url_toko','ekspedisi_anteraja','ekspedisi_shopee_express_standard','ekspedisi_shopee_express_instant',
        'ekspedisi_jnt_ekspress','ekspedisi_jnt_economy','ekspedisi_jnt_jemari','ekspedisi_ninja_xpress','ekspedisi_sicepat_reg','ekspedisi_sicepat_halu',
        'ekspedisi_jne_reg_cashless','ekspedisi_jne_yes_cashless','ekspedisi_jne_jtr_cashless','ekspedisi_grabexpress_sameday','ekspedisi_gosend_sameday',
        'ekspedisi_grabexpress_instant','ekspedisi_pos_kilat_khusus','ekspedisi_jnt_trucking','ekspedisi_reguler_cashless','ekspedisi_hemat','ekspedisi_sameday','ekspedisi_instant','ekspedisi_nextday'],
        [
            ['hiiphooray-tani','shp','210438615','https://shopee.co.id/hiiphooray_tani',true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true],
        ]);

        $this->batchInsert('setting_marketplace', ['kode_toko','kode_variabel_marketplace','url_toko'],
        [
            ['hiiphooray-tani','tkp','https://www.tokopedia.com/hiiphooray'],
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('setting_marketplace');
    }
}
