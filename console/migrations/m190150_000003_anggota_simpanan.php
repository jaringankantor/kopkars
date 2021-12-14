<?php

use yii\db\Migration;

class m190150_000003_anggota_simpanan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('anggota_simpanan', [
            'id' => $this->primaryKey(),
            'kode_toko' => $this->string(50)->notNull(),
            'anggota_id' => $this->integer()->notNull(),
            'simpanan' => $this->string(20)->notNull(),
            'debitkredit' => $this->string(6)->notNull(),
            'rupiah' => $this->integer()->notNull(),
            'keterangan' => $this->string(),
            'waktu' => $this->dateTime()->notNull()->defaultExpression('now()'),
            'last_waktu_update' => $this->dateTime(),
            'insert_by' => $this->string(50),
            'last_update_by' => $this->string(50),
            'is_deleted' => $this->boolean()->defaultValue(false),
            'deleted_at' => $this->dateTime(),
            'last_softdelete_by' => $this->string(50),
        ]);

        $this->addForeignKey('anggota_simpanan_toko_fkey', 'anggota_simpanan', 'kode_toko', 'toko', 'kode', 'RESTRICT', 'CASCADE');

        $this->addForeignKey('anggota_simpanan_anggota_fkey', 'anggota_simpanan', 'anggota_id', 'anggota', 'id', 'RESTRICT', 'CASCADE');

        $this->addForeignKey('anggota_simpanan_variabel_simpanan_fkey', 'anggota_simpanan', 'simpanan', 'variabel_simpanan', 'simpanan', 'RESTRICT', 'CASCADE');

        $sql = file_get_contents(Yii::getAlias('@kopkars-assets/sql/trigger_anggota_simpanan_updatedeletesoftdelete.sql'));
        $this->execute($sql);
        
        $this->execute('
        CREATE TRIGGER trigger_anggota_simpanan_updatedeletesoftdelete AFTER UPDATE OR DELETE ON anggota_simpanan
        FOR EACH ROW
        EXECUTE PROCEDURE trigger_anggota_simpanan_updatedeletesoftdelete()
        ');
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('anggota_simpanan');
    }
}
