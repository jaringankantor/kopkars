<?php

use yii\db\Migration;

class m400001_000005_histori_pinjaman extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('histori_pinjaman', [
            'id' => $this->primaryKey(),
            'anggota_id' => $this->integer()->notNull(),
            'pinjaman_id' => $this->integer()->notNull(),
            'pinjaman_kolom' => $this->string(50)->notNull(),
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
        $this->dropTable('histori_pinjaman');
    }
}
