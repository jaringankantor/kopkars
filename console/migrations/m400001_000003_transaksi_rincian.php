<?php

use yii\db\Migration;

class m400001_000003_transaksi_rincian extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('transaksi_rincian', [
            'id' => $this->bigPrimaryKey(),
            'transaksi_id' => $this->integer(),
            'kode_toko' => $this->string(50)->notNull(),
            'kanal_transaksi' => $this->string(20)->notNull(),
            'nomor_referensi' => $this->string(50)->notNull(),
            'nomor_referensi_rincian' => $this->text(),
            'nomor_pesanan' => $this->string(50),
            'sku' => $this->string(20), //Isi SKU untuk mempermudah dalam data mining
            'anggota_id' => $this->integer(), //isi jika transaksi dilakukan oleh anggota
            'nama_pelanggan' => $this->string(50),
            'nomor_hp' => $this->string(50),
            'email' => $this->string(50),
            'alamat' => $this->text(),
            'kurir' => $this->string(50),
            'nomor_resi' => $this->string(50),
            'is_bebasongkir' => $this->boolean()->notNull()->defaultValue(false),
            'nama_produk' => $this->text()->notNull(),
            'jumlah_barang' => $this->integer()->notNull(),
            'mata_uang' => $this->string(6)->notNull()->defaultValue('IDR'),
            'harga_awal' => $this->integer()->notNull(), //dalam jumlah mata_uang
            'diskon' => $this->integer(), //dalam jumlah mata_uang bukan persen
            'pajak' => $this->integer(), //dalam jumlah mata_uang bukan persen
            'harga_jual' => $this->integer()->notNull(), //dalam jumlah mata_uang
            'subtotal' => $this->integer()->notNull(), //Subtotal harga_awal sebelum diskon dan pajak dalam jumlah mata_uang
            'total_penjualan' => $this->integer()->notNull(), //Total harga_jual penjualan setelah diskon dan pajak dalam jumlah mata_uang
            'pembayaran' => $this->integer(), //yang dibayarkan cash dalam jumlah mata_uang
            'saldo' => $this->integer(), //yang dibayarkan mencicil/hutang/akhir bulan dalam jumlah mata_uang
            'keterangan' => $this->text(),
            'waktu' => $this->dateTime()->notNull()->defaultExpression('now()'),
            'last_waktu_update' => $this->dateTime(),
            'insert_by' => $this->string(50)->notNull(),
            'last_update_by' => $this->string(50),
            'is_deleted' => $this->boolean()->defaultValue(false),
            'deleted_at' => $this->dateTime(),
            'last_softdelete_by' => $this->string(50),
        ]);

        $this->addForeignKey('transaksi_rincian_toko_fkey', 'transaksi_rincian', 'kode_toko', 'toko', 'kode', 'RESTRICT', 'CASCADE');

        $this->addForeignKey('transaksi_rincian_variabel_kanal_transaksi_fkey', 'transaksi_rincian', 'kanal_transaksi', 'variabel_kanal_transaksi', 'kanal_transaksi', 'RESTRICT', 'CASCADE');

        $this->addForeignKey('transaksi_rincian_anggota_fkey', 'transaksi_rincian', 'anggota_id', 'anggota', 'id', 'RESTRICT', 'CASCADE');

        $this->createIndex('transaksi_rincian_kode_toko_kanal_transaksi_nomor_referensi_idx', 'transaksi_rincian', ['kode_toko', 'kanal_transaksi','nomor_referensi','nama_produk'], true);

        $sql = file_get_contents(Yii::getAlias('@kopkars-assets/sql/trigger_transaksi_rincian_insertupdatedelete.sql'));
        $this->execute($sql);
        
        $this->execute('
        CREATE TRIGGER trigger_transaksi_rincian_insertupdatedelete AFTER INSERT OR UPDATE OR DELETE ON transaksi_rincian
        FOR EACH ROW
        EXECUTE PROCEDURE trigger_transaksi_rincian_insertupdatedelete()
        ');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('transaksi_rincian');
    }
}
