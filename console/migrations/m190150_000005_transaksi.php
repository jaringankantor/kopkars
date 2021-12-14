<?php

use yii\db\Migration;

class m190150_000005_transaksi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('transaksi', [
            'id' => $this->primaryKey(),
            'kode_toko' => $this->string(50)->notNull(),
            'kanal_transaksi' => $this->string(20)->notNull(),
            'nomor_referensi' => $this->string(20),
            'nomor_pesanan' => $this->string(20),
            'anggota_id' => $this->integer(), //isi jika transaksi dilakukan oleh anggota
            'anggota_nomor_zahir' => $this->string(50), //isi jika transaksi dilakukan oleh anggota di zahir
            'nama_pelanggan' => $this->string(50),
            'mata_uang' => $this->string(6)->notNull()->defaultValue('IDR'),
            'subtotal' => $this->integer(), //dalam jumlah mata_uang
            'diskon' => $this->integer(), //dalam jumlah mata_uang bukan persen
            'pajak' => $this->integer(), //dalam jumlah mata_uang bukan persen
            'total_penjualan' => $this->integer(), //dalam jumlah mata_uang
            'pembayaran' => $this->integer(), //yang dibayarkan cash dalam jumlah mata_uang
            'saldo' => $this->integer(), //yang dibayarkan mencicil/hutang/akhir bulan dalam jumlah mata_uang
            'keterangan' => $this->string(),
            'waktu' => $this->dateTime()->notNull()->defaultExpression('now()'),
            'last_waktu_update' => $this->dateTime(),
            'insert_by' => $this->string(50),
            'last_update_by' => $this->string(50),
            'is_deleted' => $this->boolean()->defaultValue(false),
            'deleted_at' => $this->dateTime(),
            'last_softdelete_by' => $this->string(50),
        ]);

        $this->addForeignKey('transaksi_toko_fkey', 'transaksi', 'kode_toko', 'toko', 'kode', 'RESTRICT', 'CASCADE');

        $this->addForeignKey('transaksi_variabel_kanal_transaksi_fkey', 'transaksi', 'kanal_transaksi', 'variabel_kanal_transaksi', 'kanal_transaksi', 'RESTRICT', 'CASCADE');

        $this->addForeignKey('transaksi_anggota_fkey', 'transaksi', 'anggota_id', 'anggota', 'id', 'RESTRICT', 'CASCADE');

        $this->createIndex('transaksi_kanal_transaksi_nomor_referensi_idx', 'transaksi', ['kanal_transaksi','nomor_referensi']);

        $this->createIndex('transaksi_kanal_transaksi_nomor_pesanan_idx', 'transaksi', ['kanal_transaksi','nomor_pesanan']);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('transaksi');
    }
}
