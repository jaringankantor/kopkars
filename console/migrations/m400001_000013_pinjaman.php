<?php

use yii\db\Migration;

class m400001_000013_pinjaman extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pinjaman', [
            'id' => $this->primaryKey(),
            'kode_toko' => $this->string(50)->notNull(),
            'anggota_id' => $this->integer()->notNull(),
            'nomor_referensi' => $this->string(50), //Misal nomor invoice atau kuitansi
            'pesanan_pinjaman_id' => $this->integer(),
            'saldo_pokok' => $this->integer()->notNull(),
            'saldo_jasa' => $this->integer()->notNull(),
            'total_pembayaran' => $this->integer()->notNull()->defaultValue(0),
            'mulai_tanggal_pembayaran' => $this->date(),
            'rencana_tanggal_pelunasan' => $this->date(),
            'aktual_tanggal_pelunasan' => $this->date(),
            'peruntukan' => $this->string(),
            'keterangan' => $this->string(),
            'waktu' => $this->dateTime()->notNull()->defaultExpression('now()'),
            'last_waktu_update' => $this->dateTime(),
            'insert_by' => $this->string(50),
            'last_update_by' => $this->string(50),
            'is_deleted' => $this->boolean()->defaultValue(false),
            'deleted_at' => $this->dateTime(),
            'last_softdelete_by' => $this->string(50),
        ]);

        $this->addForeignKey('pinjaman_toko_fkey', 'pinjaman', 'kode_toko', 'toko', 'kode', 'RESTRICT', 'CASCADE');

        $this->addForeignKey('pinjaman_anggota_fkey', 'pinjaman', 'anggota_id', 'anggota', 'id', 'RESTRICT', 'CASCADE');

        $this->addForeignKey('pinjaman_pesanan_pinjaman_fkey', 'pinjaman', 'pesanan_pinjaman_id', 'pesanan_pinjaman', 'id', 'RESTRICT', 'CASCADE');

        $sql = file_get_contents(Yii::getAlias('@kopkars-assets/sql/trigger_pinjaman_updatedeletesoftdelete.sql'));
        $this->execute($sql);
        
        $this->execute('
        CREATE TRIGGER trigger_pinjaman_updatedeletesoftdelete AFTER UPDATE OR DELETE ON pinjaman
        FOR EACH ROW
        EXECUTE PROCEDURE trigger_pinjaman_updatedeletesoftdelete()
        ');
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('pinjaman');
    }
}
