<?php

use yii\db\Migration;

class m400001_000010_histori_voucher extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('histori_voucher', [
            'id' => $this->primaryKey(),
            'anggota_id' => $this->integer()->notNull(),
            'voucher_id' => $this->integer()->notNull(),
            'voucher_kolom' => $this->string(50)->notNull(),
            'value_old' => $this->string(255)->notNull(),
            'value_new' => $this->string(255),
            'jenis_transaksi' =>  $this->string(20)->notNull(), //update, delete, softdelete true, softdelete false
            'waktu' => $this->dateTime()->notNull()->defaultExpression('now()'),
            'by' => $this->string(50),
        ]);
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('histori_voucher');
    }
}
