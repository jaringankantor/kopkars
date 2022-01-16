<?php

use yii\db\Migration;

class m400001_000006_variabel_kanal_cicilan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('variabel_kanal_cicilan', [
            'kanal_cicilan' => $this->string(20)->notNull(),
        ]);

        $this->addPrimaryKey('variabel_kanal_cicilan_pkey','variabel_kanal_cicilan','kanal_cicilan');
        
        $this->batchInsert('variabel_kanal_cicilan', ['kanal_cicilan'], [['Potongan Gaji'],['Cash'],['Transfer']]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('variabel_kanal_cicilan');
    }
}
