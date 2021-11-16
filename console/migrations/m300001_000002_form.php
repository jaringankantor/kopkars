<?php

use yii\db\Migration;
use yii\db\Schema;

class m300001_000002_form extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('form', [
            'kode' => $this->string(150)->notNull(),
            'sheet_name' => $this->string(150)->defaultValue('Sheet1')->notNull(),
            'baris_header' => $this->integer()->defaultValue(0)->notNull(),
            'baris_isi' => $this->integer()->defaultValue(0)->notNull(),
            'deskripsi' => $this->string(2000),
            'file_excel' => $this->binary(),
            'file_extension' => $this->string(10),
            'file_name' => $this->string(150),
            'file_size' => $this->integer(),
            'file_type' => $this->string(150),
        ]);

        $this->addPrimaryKey('form_kode_pkey','form','kode');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('form');
    }
}
