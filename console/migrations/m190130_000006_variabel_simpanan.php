<?php

use yii\db\Migration;

class m190130_000006_variabel_simpanan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('variabel_simpanan', [
            'simpanan' => $this->string(20)->notNull(),
        ]);

        $this->addPrimaryKey('variabel_simpanan_pkey','variabel_simpanan','simpanan');
        
        $this->batchInsert('variabel_simpanan', ['simpanan'], [['Pokok'],['Wajib'],['Sukarela']]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('variabel_simpanan');
    }
}
