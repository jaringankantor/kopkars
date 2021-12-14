<?php

use yii\db\Migration;

class m190130_000003_variabel_unit extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('variabel_unit', [
            'unit' => $this->string(100)->notNull(),
        ]);

        $this->addPrimaryKey('variabel_unit_pkey','variabel_unit','unit');
        
        $this->batchInsert('variabel_unit', ['unit'], [
            ['Akademik dan Kemahasiswaan'],
            ['Anggaran dan Keuangan'],
            ['Bagian Tata Usaha'],
            ['CDC dan Alumni'],
            ['Direktur'],
            ['Hubungan Masyarakat dan Internasional'],
            ['Jurusan Administrasi Niaga'],
            ['Jurusan Akuntansi'],
            ['Jurusan Teknik Elektro'],
            ['Jurusan Teknik Grafika dan Penerbitan'],
            ['Jurusan Teknik Informatika dan Komputer'],
            ['Jurusan Teknik Mesin'],
            ['Jurusan Teknik Sipil'],
            ['Kerjasama Pendidikan, Penelitian, dan PKM'],
            ['Kerjasama Ventura'],
            ['Klinik'],
            ['LSP-P1'],
            ['Pelaksana Pengadaan Barang dan Jasa (UPPBJ)'],
            ['Pensiun'],
            ['Program Pascasarjana'],
            ['Pusat Unggulan Teknologi Infrastruktur (PUTI)'],
            ['Pusat Unggulan Teknologi Otomasi Industri (PUTOI)'],
            ['Rumah Tangga dan Aset'],
            ['Satuan Pengaman (Satpam)'],
            ['Satuan Pengawas Internal (SPI)'],
            ['Satuan Penjaminan Mutu (SPM)'],
            ['Sumber Daya Manusia'],
            ['Unit Kursus, Pelatihan, dan Sertifikasi'],
            ['Unit Penelitian dan Pengabdian kepada Masyarakat (UP2M)'],
            ['Unit Pengembangan Ventura'],
            ['Unit Peningkatan Mutu Pembelajaran (UPMP)'],
            ['Unit Perpustakaan dan Kearsipan'],
            ['Unit Transformasi Digital (UTD)'],
            ['Wakil Direktur Bidang Administrasi dan Keuangan (WD 2)'],
            ['Wakil Direktur Bidang Akademik (WD 1)'],
            ['Wakil Direktur Bidang Kemahasiswaan (WD 3)'],
            ['Wakil Direktur Bidang Kerjasama (WD 4)'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('variabel_unit');
    }
}
