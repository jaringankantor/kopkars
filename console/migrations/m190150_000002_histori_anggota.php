<?php

use yii\db\Migration;

class m190150_000002_histori_anggota extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('histori_anggota', [
            'id' => $this->primaryKey(),
            'anggota_id' => $this->integer(),
            'anggota_kolom' => $this->string(50),
            'value_old' => $this->string(255),
            'value_new' => $this->string(255),
            'waktu_update' => $this->dateTime()->notNull()->defaultExpression('now()'),
        ]);        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('histori_anggota');
    }
}
