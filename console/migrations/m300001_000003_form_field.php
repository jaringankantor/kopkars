<?php

use yii\db\Migration;
use yii\db\Schema;

class m300001_000003_form_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('form_field', [
            'id' => $this->bigPrimaryKey(),
            'kode_form' => $this->string(50)->notNull(),
            'kode_field' => $this->string(50),
            'nama_field_excel' => $this->string(70)->notNull(),
            'deskripsi' => $this->string(2000),
        ]);

        $this->addForeignKey('form_field_kode_field_fkey', 'form_field', 'kode_field', 'field', 'kode', 'RESTRICT', 'CASCADE');

        $this->addForeignKey('form_field_kode_form_fkey', 'form_field', 'kode_form', 'form', 'kode', 'RESTRICT', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('form_field');
    }
}
