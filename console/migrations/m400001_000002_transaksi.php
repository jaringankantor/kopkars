<?php

use yii\db\Migration;

class m400001_000002_transaksi extends Migration
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
            'nomor_referensi' => $this->string(50)->notNull(), //Misal nomor invoice
            'nomor_pesanan' => $this->string(50),
            'anggota_id' => $this->integer(), //isi jika transaksi dilakukan oleh anggota
            'anggota_nomor_zahir' => $this->string(50), //isi jika transaksi dilakukan oleh anggota di zahir
            'nama_pelanggan' => $this->string(50),
            'nomor_hp' => $this->string(50),
            'email' => $this->string(50),
            'alamat' => $this->text(),
            'kurir' => $this->string(50),
            'nomor_resi' => $this->string(50),
            'is_bebasongkir' => $this->boolean()->notNull()->defaultValue(false),
            'mata_uang' => $this->string(6)->notNull()->defaultValue('IDR'),
            'diskon' => $this->integer(), //dalam jumlah mata_uang bukan persen
            'pajak' => $this->integer(), //dalam jumlah mata_uang bukan persen
            'subtotal' => $this->integer()->notNull(), //Subtotal harga_awal sebelum diskon dan pajak dalam jumlah mata_uang
            'total_penjualan' => $this->integer()->notNull(), //Total harga_jual penjualan setelah diskon dan pajak dalam jumlah mata_uang
            'pembayaran' => $this->integer(), //yang dibayarkan cash dalam jumlah mata_uang
            'saldo' => $this->integer(), //yang dibayarkan mencicil/hutang/akhir bulan dalam jumlah mata_uang
            'keterangan' => $this->text(), //keterangan akan bertambah jika setiap detil transaksi terisi, dipisahkan |
            'waktu' => $this->dateTime()->notNull()->defaultExpression('now()'),
            'last_waktu_update' => $this->dateTime(),
            'insert_by' => $this->string(50)->notNull(),
            'last_update_by' => $this->string(50),
            'is_deleted' => $this->boolean()->defaultValue(false),
            'deleted_at' => $this->dateTime(),
            'last_softdelete_by' => $this->string(50),
        ]);

        $this->addForeignKey('transaksi_toko_fkey', 'transaksi', 'kode_toko', 'toko', 'kode', 'RESTRICT', 'CASCADE');

        $this->addForeignKey('transaksi_variabel_kanal_transaksi_fkey', 'transaksi', 'kanal_transaksi', 'variabel_kanal_transaksi', 'kanal_transaksi', 'RESTRICT', 'CASCADE');

        $this->addForeignKey('transaksi_anggota_fkey', 'transaksi', 'anggota_id', 'anggota', 'id', 'RESTRICT', 'CASCADE');

        $this->createIndex('transaksi_kode_toko_kanal_transaksi_nomor_referensi_idx', 'transaksi', ['kode_toko', 'kanal_transaksi','nomor_referensi'], true);

        //$this->createIndex('transaksi_kode_toko_kanal_transaksi_nomor_pesanan_idx', 'transaksi', ['kode_toko', 'kanal_transaksi','nomor_pesanan'], true);

        $this->execute('
        CREATE UNIQUE INDEX transaksi_kode_toko_kanal_transaksi_nomor_pesanan_idx ON transaksi (kode_toko,kanal_transaksi,nomor_pesanan)
        WHERE nomor_pesanan IS NOT NULL
        ');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('transaksi');
    }
}
