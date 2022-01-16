<?php

use yii\db\Migration;

class m400001_000007_cicilan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('cicilan', [
            'id' => $this->primaryKey(),
            'kode_toko' => $this->string(50)->notNull(),
            'anggota_id' => $this->integer()->notNull(),
            'kanal_cicilan' => $this->string(20)->notNull(),
            'nomor_referensi' => $this->string(50), //Misal nomor invoice atau kuitansi
            'cicilan' => $this->integer()->notNull(),
            'keterangan' => $this->string(),
            'waktu' => $this->dateTime()->notNull()->defaultExpression('now()'),
            'last_waktu_update' => $this->dateTime(),
            'insert_by' => $this->string(50),
            'last_update_by' => $this->string(50),
            'is_deleted' => $this->boolean()->defaultValue(false),
            'deleted_at' => $this->dateTime(),
            'last_softdelete_by' => $this->string(50),
        ]);

        $this->addForeignKey('cicilan_toko_fkey', 'cicilan', 'kode_toko', 'toko', 'kode', 'RESTRICT', 'CASCADE');

        $this->addForeignKey('cicilan_anggota_fkey', 'cicilan', 'anggota_id', 'anggota', 'id', 'RESTRICT', 'CASCADE');

        $this->addForeignKey('cicilan_variabel_kanal_cicilan_fkey', 'cicilan', 'kanal_cicilan', 'variabel_kanal_cicilan', 'kanal_cicilan', 'RESTRICT', 'CASCADE');

        //$sql = file_get_contents(Yii::getAlias('@kopkars-assets/sql/trigger_cicilan_updatedeletesoftdelete.sql'));
        //$this->execute($sql);
        
        $this->execute('
        CREATE TRIGGER trigger_cicilan_updatedeletesoftdelete AFTER UPDATE OR DELETE ON cicilan
        FOR EACH ROW
        EXECUTE PROCEDURE trigger_cicilan_updatedeletesoftdelete()
        ');
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('cicilan');
    }
}
