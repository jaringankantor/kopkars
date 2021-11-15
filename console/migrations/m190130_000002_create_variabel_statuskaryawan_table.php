<?php

use yii\db\Migration;

class m190130_000002_create_variabel_statuskaryawan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('variabel_statuskaryawan', [
            'statuskaryawan' => $this->string(20)->notNull(),
        ]);

        $this->addPrimaryKey('variabel_statuskaryawan_pkey','variabel_statuskaryawan','statuskaryawan');
        
        $this->batchInsert('variabel_statuskaryawan', ['statuskaryawan'], [['DOSEN PARTIMER'],['DOSEN TETAP NON PNS'],['DOSEN TETAP PNS'],['PENSIUN PNS'],['PPNPN'],['TENDIK PNS']]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('variabel_statuskaryawan');
    }
}
