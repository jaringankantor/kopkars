<?php

use yii\db\Migration;

class m400001_000011_pesanan_pinjaman extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pesanan_pinjaman', [
            'id' => $this->bigPrimaryKey(),
            'kode_toko' => $this->string(50)->notNull(),
            'anggota_id' => $this->integer()->notNull(),
            'nomor_referensi' => $this->string(50), //Misal nomor invoice atau kuitansi
            'saldo_pokok' => $this->integer()->notNull(),
            'saldo_jasa' => $this->integer()->notNull(),
            'total_pembayaran' => $this->integer()->notNull()->defaultValue(0),
            'mulai_tanggal_pembayaran' => $this->date(),
            'rencana_tanggal_pelunasan' => $this->date(),
            'aktual_tanggal_pelunasan' => $this->date(),
            'peruntukan' => $this->string(),
            'lampiran' => $this->binary(),
            'keterangan' => $this->string(),
            'waktu' => $this->dateTime()->notNull()->defaultExpression('now()'),
            'last_update_by' => $this->string(50),
            'is_approved_level1' => $this->boolean()->defaultValue(false),
            'is_approved_level2' => $this->boolean()->defaultValue(false),
            'is_processed' => $this->boolean()->defaultValue(false),
        ]);

        $this->addForeignKey('pesanan_pinjaman_toko_fkey', 'pesanan_pinjaman', 'kode_toko', 'toko', 'kode', 'RESTRICT', 'CASCADE');

        $this->addForeignKey('pesanan_pinjaman_anggota_fkey', 'pesanan_pinjaman', 'anggota_id', 'anggota', 'id', 'RESTRICT', 'CASCADE');

        $sql = file_get_contents(Yii::getAlias('@kopkars-assets/sql/trigger_pesanan_pinjaman_update.sql'));
        $this->execute($sql);
        
        $this->execute('
        CREATE TRIGGER trigger_pesanan_pinjaman_update AFTER UPDATE ON pesanan_pinjaman
        FOR EACH ROW
        EXECUTE PROCEDURE trigger_pesanan_pinjaman_update()
        ');
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('pesanan_pinjaman');
    }
}
