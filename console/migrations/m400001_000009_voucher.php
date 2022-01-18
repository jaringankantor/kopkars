<?php

use yii\db\Migration;

class m400001_000009_voucher extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('voucher', [
            'kode_voucher' => $this->string(10)->notNull(),
            'nama_voucher' => $this->string(20)->notNull(),
            'kode_toko' => $this->string(50)->notNull(),
            'anggota_id' => $this->integer()->notNull(),
            'rupiah' => $this->integer()->notNull(),
            'rupiah_terpakai'  => $this->integer()->notNull()->defaultValue(0),
            'berlaku_mulai' => $this->dateTime()->notNull()->defaultExpression('now()'),
            'berakhir_sampai' => $this->dateTime()->notNull(),
            'keterangan' => $this->string(),
            'waktu' => $this->dateTime()->notNull()->defaultExpression('now()'),
            'last_waktu_update' => $this->dateTime(),
            'insert_by' => $this->string(50),
            'last_update_by' => $this->string(50),
            'is_deleted' => $this->boolean()->defaultValue(false),
            'deleted_at' => $this->dateTime(),
            'last_softdelete_by' => $this->string(50),
        ]);

        $this->addPrimaryKey('voucher_kode_voucher_pkey','voucher',array('kode_voucher','kode_toko'));

        $this->addForeignKey('voucher_toko_fkey', 'voucher', 'kode_toko', 'toko', 'kode', 'RESTRICT', 'CASCADE');

        $this->addForeignKey('voucher_anggota_fkey', 'voucher', 'anggota_id', 'anggota', 'id', 'RESTRICT', 'CASCADE');

        $sql = file_get_contents(Yii::getAlias('@kopkars-assets/sql/trigger_voucher_updatedeletesoftdelete.sql'));
        $this->execute($sql);
        
        $this->execute('
        CREATE TRIGGER trigger_voucher_updatedeletesoftdelete AFTER UPDATE OR DELETE ON voucher
        FOR EACH ROW
        EXECUTE PROCEDURE trigger_voucher_updatedeletesoftdelete()
        ');
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('voucher');
    }
}
