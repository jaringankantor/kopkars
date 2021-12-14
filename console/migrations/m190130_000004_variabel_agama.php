<?php

use yii\db\Migration;

class m190130_000004_variabel_agama extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('variabel_agama', [
            'agama' => $this->string(20)->notNull(),
        ]);

        $this->addPrimaryKey('variabel_agama_pkey','variabel_agama','agama');
        
        $this->batchInsert('variabel_agama', ['agama'], [['ISLAM'],['KRISTEN'],['KATOLIK'],['HINDU'],['BUDHA'],['KHONG HU CU']]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('variabel_agama');
    }
}
