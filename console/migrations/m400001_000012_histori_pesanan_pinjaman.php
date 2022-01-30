<?php

use yii\db\Migration;

class m400001_000012_histori_pesanan_pinjaman extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('histori_pesanan_pinjaman', [
            'id' => $this->primaryKey(),
            'anggota_id' => $this->integer()->notNull(),
            'pesanan_pinjaman_id' => $this->integer()->notNull(),
            'pesanan_pinjaman_kolom' => $this->string(50)->notNull(),
            'value_old' => $this->string(255)->notNull(),
            'value_new' => $this->string(255),
            'jenis_transaksi' =>  $this->string(20)->notNull(), //update
            'waktu' => $this->dateTime()->notNull()->defaultExpression('now()'),
            'by' => $this->string(50),
        ]);

        $this->addForeignKey('histori_pesanan_pinjaman_pesanan_pinjaman_fkey', 'histori_pesanan_pinjaman', 'pesanan_pinjaman_id', 'pesanan_pinjaman', 'id', 'CASCADE', 'CASCADE');
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('histori_pesanan_pinjaman');
    }
}
