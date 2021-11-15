<?php

use yii\db\Migration;

class m190130_000005_create_variabel_pendidikanterakhir_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('variabel_pendidikanterakhir', [
            'pendidikanterakhir' => $this->string(20)->notNull(),
        ]);

        $this->addPrimaryKey('variabel_pendidikanterakhir_pkey','variabel_pendidikanterakhir','pendidikanterakhir');
        
        $this->batchInsert('variabel_pendidikanterakhir', ['pendidikanterakhir'], [['SD'],['SLTP'],['SLTA'],['D1'],['D2'],['D3'],['D4/S1'],['S2'],['S3']]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('variabel_pendidikanterakhir');
    }
}
