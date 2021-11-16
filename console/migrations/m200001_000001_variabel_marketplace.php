<?php

use yii\db\Migration;

class m200001_000001_variabel_marketplace extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('variabel_marketplace', [
            'kode_toko' => $this->string(50)->notNull(),
            'kode' => $this->string(3),
            'marketplace' => $this->string(50)->notNull(),
        ]);

        $this->addPrimaryKey('variabel_marketplace_kode_pkey', 'variabel_marketplace',array('kode_toko','kode'));

        $this->addForeignKey('variabel_marketplace_toko_fkey', 'variabel_marketplace', 'kode_toko', 'toko', 'kode', 'RESTRICT', 'CASCADE');

        $this->batchInsert('variabel_marketplace', ['kode_toko','kode','marketplace'],
        [
            ['hiiphooray-tani','bli','Blibli'],
            ['hiiphooray-tani','bkl','Bukalapak'],
            ['hiiphooray-tani','fbc','Facebook Catalog'],
            ['hiiphooray-tani','fbm','Facebook Marketplace'],
            ['hiiphooray-tani','jdi','JD.ID'],
            ['hiiphooray-tani','lzd','Lazada'],
            ['hiiphooray-tani','shp','Shopee'],
            ['hiiphooray-tani','tkp','Tokopedia'],
            ['hiiphooray-tani','zbz','Zobaze'],
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('variabel_marketplace');
    }
}
