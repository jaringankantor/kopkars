<?php

use yii\db\Migration;

class m200001_000003_variabel_marketplace_etalase extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('variabel_marketplace_etalase', [
            'kode_toko' => $this->string(50)->notNull(),
            'kode_variabel_marketplace' => $this->string(3)->notNull(),
            'kode' => $this->string(50)->notNull(),
            'marketplace_etalase' => $this->string()->notNull(),
        ]);

        $this->addPrimaryKey('variabel_marketplace_etalase_kode_variabel_marketplace_kode_pkey','variabel_marketplace_etalase',array('kode_toko','kode_variabel_marketplace','kode'));

        $this->addForeignKey('variabel_marketplace_etalase_toko_fkey', 'variabel_marketplace_etalase', 'kode_toko', 'toko', 'kode', 'RESTRICT', 'CASCADE');

        //sudah tidak berlaku karena ada kode_toko di reference tablenya
        //$this->addForeignKey('variabel_marketplace_etalase_variabel_marketplace_fkey', 'variabel_marketplace_etalase', 'kode_variabel_marketplace', 'variabel_marketplace', 'kode', 'RESTRICT', 'CASCADE');

        $this->createIndex('variabel_marketplace_etalase_kode_variabel_marketplace_kode_idx', 'variabel_marketplace_etalase', ['kode_variabel_marketplace','kode']);

        $this->batchInsert('variabel_marketplace_etalase', ['kode_toko','kode_variabel_marketplace','kode','marketplace_etalase'],
        [
            ['hiiphooray-tani','tkp','26294339','Benih'],
            ['hiiphooray-tani','tkp','27016162','Bibit Tanaman'],
            ['hiiphooray-tani','tkp','27014029','Drum'],
            ['hiiphooray-tani','tkp','26675034','Media Tanam'],
            ['hiiphooray-tani','tkp','26215593','Peralatan Tani'],
            ['hiiphooray-tani','tkp','26675068','Perikanan'],
            ['hiiphooray-tani','tkp','26174112','Perlengkapan Tani'],
            ['hiiphooray-tani','tkp','26174089','Pestisida'],
            ['hiiphooray-tani','tkp','26675031','Planter Bag'],
            ['hiiphooray-tani','tkp','26174095','Polybag Seedling Bag'],
            ['hiiphooray-tani','tkp','26174092','Pupuk'],
            ['hiiphooray-tani','tkp','26174119','ZPT dan Hormon'],
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('variabel_marketplace_etalase');
    }
}
