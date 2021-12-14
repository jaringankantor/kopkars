<?php

use yii\db\Migration;

class m190130_000001_variabel_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('variabel_status', [
            'status' => $this->string(20)->notNull(),
        ]);

        $this->addPrimaryKey('variabel_status_pkey','variabel_status','status');
        
        $this->batchInsert('variabel_status', ['status'], [['Aktif'],['Non Aktif'],['Keluar']]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('variabel_status');
    }
}
