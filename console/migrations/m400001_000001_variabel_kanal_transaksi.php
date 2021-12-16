<?php

use yii\db\Migration;

class m400001_000001_variabel_kanal_transaksi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('variabel_kanal_transaksi', [
            'kanal_transaksi' => $this->string(20)->notNull(),
        ]);

        $this->addPrimaryKey('variabel_kanal_transaksi_pkey','variabel_kanal_transaksi','kanal_transaksi');
        
        $this->batchInsert('variabel_kanal_transaksi', ['kanal_transaksi'], [['bukalapak'],['blibli'],['jdid'],['lazada'],['shopee'],['tokopedia']['web-backend'],['web-frontend'],['zahir']]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('variabel_kanal_transaksi');
    }
}
