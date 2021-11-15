<?php

use yii\db\Migration;

class m190130_000007_create_variabel_kanal_transaksi_table extends Migration
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
        
        $this->batchInsert('variabel_kanal_transaksi', ['kanal_transaksi'], [['web-backend'],['web-frontend'],['zahir']]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('variabel_kanal_transaksi');
    }
}
