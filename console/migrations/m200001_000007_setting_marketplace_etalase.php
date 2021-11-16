<?php

use yii\db\Migration;
use yii\db\Schema;

class m200001_000007_setting_marketplace_etalase extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('setting_marketplace_etalase', [
            'kode_toko' => $this->string(50)->notNull(),
            'kode_variabel_marketplace'=> $this->string(3),
            'kode_variabel_marketplace_etalase'=> $this->string(150)->notNull(),
            'sku_produk' => $this->string(20)->notNull(),
        ]);

        $this->addPrimaryKey('setting_marketplace_etalase_pkey','setting_marketplace_etalase',array('kode_toko','kode_variabel_marketplace','kode_variabel_marketplace_etalase','sku_produk'));

        $this->addForeignKey('setting_marketplace_etalase_toko_fkey', 'setting_marketplace_etalase', 'kode_toko', 'toko', 'kode', 'RESTRICT', 'CASCADE');

        //sudah tidak berlaku karena ada kode_toko di reference tablenya
        //$this->addForeignKey('setting_marketplace_etalase_variabel_marketplace_fkey', 'setting_marketplace_etalase', 'kode_variabel_marketplace', 'variabel_marketplace', 'kode', 'RESTRICT', 'CASCADE');

        //sudah tidak berlaku karena ada kode_toko di reference tablenya
        //$this->addForeignKey('setting_marketplace_etalase_produk_fkey', 'setting_marketplace_etalase', 'sku_produk', 'produk', 'sku', 'RESTRICT', 'CASCADE');

        $this->batchInsert('setting_marketplace_etalase', ['kode_toko','kode_variabel_marketplace','kode_variabel_marketplace_etalase','sku_produk'],
        [
            ['hiiphooray-tani','tkp','26174092','SKUHT0001'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0002'],
            ['hiiphooray-tani','tkp','26174089','SKUHT0003'],
            ['hiiphooray-tani','tkp','26174089','SKUHT0004'],
            ['hiiphooray-tani','tkp','26215593','SKUHT0005'],
            ['hiiphooray-tani','tkp','26215593','SKUHT0006'],
            ['hiiphooray-tani','tkp','26215593','SKUHT0007'],
            ['hiiphooray-tani','tkp','26174089','SKUHT0008'],
            ['hiiphooray-tani','tkp','26174089','SKUHT0009'],
            ['hiiphooray-tani','tkp','26174089','SKUHT0010'],
            ['hiiphooray-tani','tkp','26174089','SKUHT0011'],
            ['hiiphooray-tani','tkp','26174089','SKUHT0012'],
            ['hiiphooray-tani','tkp','26174112','SKUHT0013'],
            ['hiiphooray-tani','tkp','26174112','SKUHT0014'],
            ['hiiphooray-tani','tkp','26174089','SKUHT0015'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0016'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0017'],
            ['hiiphooray-tani','tkp','26174095','SKUHT0018'],
            ['hiiphooray-tani','tkp','26174095','SKUHT0019'],
            ['hiiphooray-tani','tkp','26174095','SKUHT0020'],
            ['hiiphooray-tani','tkp','26174095','SKUHT0021'],
            ['hiiphooray-tani','tkp','26174095','SKUHT0022'],
            ['hiiphooray-tani','tkp','26174095','SKUHT0023'],
            ['hiiphooray-tani','tkp','26215593','SKUHT0024'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0025'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0026'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0027'],
            ['hiiphooray-tani','tkp','26174119','SKUHT0028'],
            ['hiiphooray-tani','tkp','26174119','SKUHT0029'],
            ['hiiphooray-tani','tkp','26294339','SKUHT0030'],
            ['hiiphooray-tani','tkp','26294339','SKUHT0031'],
            ['hiiphooray-tani','tkp','26294339','SKUHT0032'],
            ['hiiphooray-tani','tkp','26294339','SKUHT0033'],
            ['hiiphooray-tani','tkp','26215593','SKUHT0034'],
            ['hiiphooray-tani','tkp','26215593','SKUHT0035'],
            ['hiiphooray-tani','tkp','26174089','SKUHT0036'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0037'],
            ['hiiphooray-tani','tkp','26215593','SKUHT0038'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0039'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0040'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0041'],
            ['hiiphooray-tani','tkp','26294339','SKUHT0042'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0043'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0044'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0045'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0046'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0047'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0048'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0049'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0050'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0051'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0052'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0053'],
            ['hiiphooray-tani','tkp','26174112','SKUHT0054'],
            ['hiiphooray-tani','tkp','26174112','SKUHT0055'],
            ['hiiphooray-tani','tkp','26174112','SKUHT0056'],
            ['hiiphooray-tani','tkp','26675068','SKUHT0057'],
            ['hiiphooray-tani','tkp','26675068','SKUHT0058'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0059'],
            ['hiiphooray-tani','tkp','26675031','SKUHT0060'],
            ['hiiphooray-tani','tkp','26675031','SKUHT0061'],
            ['hiiphooray-tani','tkp','26174095','SKUHT0062'],
            ['hiiphooray-tani','tkp','26174095','SKUHT0063'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0064'],
            ['hiiphooray-tani','tkp','26675034','SKUHT0065'],
            ['hiiphooray-tani','tkp','26675034','SKUHT0066'],
            ['hiiphooray-tani','tkp','26675068','SKUHT0067'],
            ['hiiphooray-tani','tkp','26675068','SKUHT0068'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0069'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0070'],
            ['hiiphooray-tani','tkp','26215593','SKUHT0071'],
            ['hiiphooray-tani','tkp','26174112','SKUHT0072'],
            ['hiiphooray-tani','tkp','26675031','SKUHT0073'],
            ['hiiphooray-tani','tkp','26174112','SKUHT0074'],
            ['hiiphooray-tani','tkp','26174112','SKUHT0075'],
            ['hiiphooray-tani','tkp','26174112','SKUHT0076'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0077'],
            ['hiiphooray-tani','tkp','26174092','SKUHT0078'],
            ['hiiphooray-tani','tkp','27014029','SKUHT0079'],
            ['hiiphooray-tani','tkp','27014029','SKUHT0080'],
            ['hiiphooray-tani','tkp','27016162','SKUHT0081'],
            ['hiiphooray-tani','tkp','27016162','SKUHT0082'],
            ['hiiphooray-tani','tkp','26215593','SKUHT0083'],
            ['hiiphooray-tani','tkp','26215593','SKUHT0084'],
            ['hiiphooray-tani','tkp','26215593','SKUHT0085'],
            ['hiiphooray-tani','tkp','26215593','SKUHT0086'],
            ['hiiphooray-tani','tkp','26215593','SKUHT0087'],
            ['hiiphooray-tani','tkp','26215593','SKUHT0088'],
            ['hiiphooray-tani','tkp','26215593','SKUHT0089'],
            ['hiiphooray-tani','tkp','26215593','SKUHT0090'],
            ['hiiphooray-tani','tkp','26174119','SKUHT0091'],
            ['hiiphooray-tani','tkp','26174119','SKUHT0092'],
            ['hiiphooray-tani','tkp','26174119','SKUHT0093'],
            ['hiiphooray-tani','tkp','26174119','SKUHT0094'],
            ['hiiphooray-tani','tkp','26174119','SKUHT0095'],
            ['hiiphooray-tani','tkp','26174119','SKUHT0096'],
            ['hiiphooray-tani','tkp','26174119','SKUHT0097'],
            ['hiiphooray-tani','tkp','26174119','SKUHT0098'],
            ['hiiphooray-tani','tkp','26675034','SKUHT0099'],
            ['hiiphooray-tani','tkp','26675034','SKUHT0100'],
            ['hiiphooray-tani','tkp','26675034','SKUHT0101'],
            ['hiiphooray-tani','tkp','26675034','SKUHT0102'],
            ['hiiphooray-tani','tkp','26174112','SKUHT0103'],
            ['hiiphooray-tani','tkp','26174112','SKUHT0104'],
            ['hiiphooray-tani','tkp','26215593','SKUHT0105'],
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('setting_marketplace_etalase');
    }
}
