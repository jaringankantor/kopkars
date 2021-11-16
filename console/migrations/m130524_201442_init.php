<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $this->createTable('toko', [
            'kode' => $this->string(50)->notNull(),
            'nama_toko'=> $this->string(50)->notNull(),
            'skuprefix1'=> $this->string(10),
            'skuprefix2'=> $this->string(10),
            'skuprefix3'=> $this->string(10),
            'skuprefix4'=> $this->string(10),
            'skuprefix5'=> $this->string(10),
            'skuprefix6'=> $this->string(10),
            'skuprefix7'=> $this->string(10),
            'skuprefix8'=> $this->string(10),
            'skuprefix9'=> $this->string(10),
            'skuprefix10'=> $this->string(10),
        ]);

        $this->addPrimaryKey('toko_kode_pkey','toko','kode');

        $this->batchInsert('toko', ['kode','nama_toko','skuprefix1','skuprefix2','skuprefix3','skuprefix4','skuprefix5','skuprefix6','skuprefix7','skuprefix8','skuprefix9','skuprefix10'],
        [
            ['hiiphooray','HiipHooray','SKUNH',null,null,null,null,null,null,null,null,null],
            ['hiiphooray-tani','HiipHooray Tani','SKUHT','SKUYC',null,null,null,null,null,null,null,null],
        ]);
        
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'kode_toko' => $this->string(50)->notNull(),
            'email' => $this->string(50)->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_default' => $this->string(150)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'skuprefix1'=> $this->string(10),
            'skuprefix2'=> $this->string(10),
            'skuprefix3'=> $this->string(10),
            'skuprefix4'=> $this->string(10),
            'skuprefix5'=> $this->string(10),
            'skuprefix6'=> $this->string(10),
            'skuprefix7'=> $this->string(10),
            'skuprefix8'=> $this->string(10),
            'skuprefix9'=> $this->string(10),
            'skuprefix10'=> $this->string(10),
        ], $tableOptions);

        $this->addForeignKey('{%user}_toko_fkey', '{{%user}}', 'kode_toko', 'toko', 'kode', 'RESTRICT', 'CASCADE');

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
        $this->dropTable('{{%user}}');
        $this->dropTable('toko');
    }
}
