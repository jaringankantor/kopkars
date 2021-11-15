<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;

        $this->createTable('session', [
            'id' => $this->string(40),
            'expire' => $this->integer(),
            'data' => $this->binary(),
        ]);
        $this->addPrimaryKey('session_pkey', 'session', 'id');
        
        $this->createTable('cache', [
            'id' => $this->string(128),
            'expire' => $this->integer(11),
            'data' => $this->binary(),
        ]);
        $this->addPrimaryKey('cache_pkey', 'cache', 'id');
    }

    public function down()
    {
        $this->dropTable('session');
        $this->dropTable('cache');
    }
}
