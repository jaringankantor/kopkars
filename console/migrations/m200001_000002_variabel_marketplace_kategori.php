<?php

use yii\db\Migration;

class m200001_000002_variabel_marketplace_kategori extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('variabel_marketplace_kategori', [
            'kode_toko' => $this->string(50)->notNull(),
            'kode_variabel_marketplace' => $this->string(3)->notNull(),
            'kode' => $this->string(150)->notNull(),
            'marketplace_kategori' => $this->string()->notNull(),
        ]);

        $this->addPrimaryKey('variabel_marketplace_kategori_kode_variabel_marketplace_kode_pkey','variabel_marketplace_kategori',array('kode_toko','kode_variabel_marketplace','kode'));

        $this->addForeignKey('variabel_marketplace_kategori_toko_fkey', 'variabel_marketplace_kategori', 'kode_toko', 'toko', 'kode', 'RESTRICT', 'CASCADE');

        //sudah tidak berlaku karena ada kode_toko di reference tablenya
        //$this->addForeignKey('variabel_marketplace_kategori_variabel_marketplace_fkey', 'variabel_marketplace_kategori', 'kode_variabel_marketplace', 'variabel_marketplace', 'kode', 'RESTRICT', 'CASCADE');

        $this->createIndex('variabel_marketplace_kategori_kode_variabel_marketplace_kode_idx', 'variabel_marketplace_kategori', ['kode_variabel_marketplace','kode']);

        $this->batchInsert('variabel_marketplace_kategori', ['kode_toko','kode_variabel_marketplace','kode','marketplace_kategori'],
        [
            ['hiiphooray-tani','bkl','benih-tanaman-898','Benih Tanaman'],
            ['hiiphooray-tani','bkl','bibit-tanaman-89e','Bibit Tanaman'],
            ['hiiphooray-tani','bkl','makanan-hewan-peliharaan-763','Makanan Hewan Peliharaan'],
            ['hiiphooray-tani','bkl','peralatan-berkebun-8a4','Peralatan Berkebun'],
            ['hiiphooray-tani','bkl','pupuk-nutrisi-tanaman-8a1','Pupuk & Nutrisi Tanaman'],
            ['hiiphooray-tani','bli','Penanggulangan Hama Insektisida','Penanggulangan Hama Insektisida'],
            ['hiiphooray-tani','bli','Perlengkapan Taman Lainnya','Perlengkapan Taman Lainnya'],
            ['hiiphooray-tani','jdi','75061777 - Home Living / Outdoor & Garden / Lawn & Garden','Lawn & Garden'],
            ['hiiphooray-tani','fbc','Home & Garden > Lawn & Garden > Gardening','Gardening'],
            ['hiiphooray-tani','lzd','Hiasandekorasitaman','Hiasan & dekorasi taman'],
            ['hiiphooray-tani','lzd','PembasmiRumputLiarHama','Pembasmi Rumput Liar & Hama'],
            ['hiiphooray-tani','lzd','PeralatanKebun','Peralatan Kebun'],
            ['hiiphooray-tani','lzd','MakananIkan','Makanan Ikan'],
            ['hiiphooray-tani','lzd','PotPotBesarGuciTaman','Pot, Pot Besar & Guci Taman'],
            ['hiiphooray-tani','lzd','SistemPengairan','Sistem Pengairan'],
            ['hiiphooray-tani','lzd','TanahPupukMulsa','Tanah, Pupuk & Mulsa'],
            ['hiiphooray-tani','lzd','TanamanBijidanUmbi','Tanaman, Biji dan Umbi'],
            ['hiiphooray-tani','shp','2202','Hobi & Koleksi/Perawatan Hewan'],
            ['hiiphooray-tani','shp','9640','Perlengkapan Rumah/Taman/Benih'],
            ['hiiphooray-tani','shp','12394','Perlengkapan Rumah/Taman/Media Tanam'],
            ['hiiphooray-tani','shp','12266','Perlengkapan Rumah/Taman/Peralatan Berkebun'],
            ['hiiphooray-tani','shp','9639','Perlengkapan Rumah/Taman/Pot'],
            ['hiiphooray-tani','shp','9641','Perlengkapan Rumah/Taman/Pupuk'],
            ['hiiphooray-tani','tkp','4235','Alat Semprot Hama'],
            ['hiiphooray-tani','tkp','1655','Benih Bibit Tanaman'],
            ['hiiphooray-tani','tkp','4133','Filter Akuarium'],
            ['hiiphooray-tani','tkp','1659','Hiasan Taman'],
            ['hiiphooray-tani','tkp','577','Lainnya'],
            ['hiiphooray-tani','tkp','4240','Mata Bor'],
            ['hiiphooray-tani','tkp','1753','Media Tanam'],
            ['hiiphooray-tani','tkp','4130','Pelet Ikan'],
            ['hiiphooray-tani','tkp','3753','Pemotong Rumput'],
            ['hiiphooray-tani','tkp','4284','Pengukur Temperatur'],
            ['hiiphooray-tani','tkp','1656','Pot Tanaman'],
            ['hiiphooray-tani','tkp','1657','Pupuk'],
            ['hiiphooray-tani','tkp','3750','Sekop Taman'],
            ['hiiphooray-tani','zbz','Benih','Benih'],
            ['hiiphooray-tani','zbz','Bibit Tanaman','Bibit Tanaman'],
            ['hiiphooray-tani','zbz','Drum','Drum'],
            ['hiiphooray-tani','zbz','Media Tanam','Media Tanam'],
            ['hiiphooray-tani','zbz','Pakan Ikan','Pakan Ikan'],
            ['hiiphooray-tani','zbz','Peralatan Tani','Peralatan Tani'],
            ['hiiphooray-tani','zbz','Perikanan','Perikanan'],
            ['hiiphooray-tani','zbz','Perlengkapan Tani','Perlengkapan Tani'],
            ['hiiphooray-tani','zbz','Pestisida','Pestisida'],
            ['hiiphooray-tani','zbz','Planter Bag','Planter Bag'],
            ['hiiphooray-tani','zbz','Polybag','Polybag'],
            ['hiiphooray-tani','zbz','Pupuk','Pupuk'],
            ['hiiphooray-tani','zbz','ZPT dan Hormon','ZPT dan Hormon'],
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('variabel_marketplace_kategori');
    }
}
