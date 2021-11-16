<?php

use yii\db\Migration;
use yii\db\Schema;

class m300001_000001_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('field', [
            'kode' => $this->string(50)->notNull(),
            'deskripsi' => $this->string(2000),
        ]);

        $this->addPrimaryKey('field_kode_pkey','field','kode');

        $this->batchInsert('field', ['kode'],
        [
            ['aftersale'],
            ['asuransi'],
            ['berat'],
            ['buyable'],
            ['deskripsi'],
            ['deskripsi_hp'],
            ['dimensi'],
            ['ekspedisi_anteraja'],
            ['ekspedisi_shopee_express_standard'],
            ['ekspedisi_shopee_express_instant'],
            ['ekspedisi_jnt_ekspress'],
            ['ekspedisi_jnt_economy'],
            ['ekspedisi_jnt_jemari'],
            ['ekspedisi_ninja_xpress'],
            ['ekspedisi_sicepat_reg'],
            ['ekspedisi_sicepat_halu'],
            ['ekspedisi_jne_reg_cashless'],
            ['ekspedisi_jne_yes_cashless'],
            ['ekspedisi_jne_jtr_cashless'],
            ['ekspedisi_grabexpress_sameday'],
            ['ekspedisi_gosend_sameday'],
            ['ekspedisi_grabexpress_instant'],
            ['ekspedisi_pos_kilat_khusus'],
            ['gambar1'],
            ['gambar2'],
            ['gambar3'],
            ['gambar4'],
            ['gambar5'],
            ['gambar2345'],
            ['harga'],
            ['harga_modal'],
            ['hargapenjualan'],
            ['is_berbahaya'],
            ['isikotak'],
            ['kategorikode'],
            ['kodetoko'],
            ['kondisi'],
            ['lebar'],
            ['merk'],
            ['nama'],
            ['minimumpemesanan'],
            ['nama_sku'],
            ['nomoretalase'],
            ['panjang'],
            ['pengiriman'],
            ['piece_type'],
            ['produk_keyword'],
            ['sale_attribute1'],
            ['sale_attribute_value1'],
            ['sku'],
            ['skuid'],
            ['spuid'],
            ['status'],
            ['stok'],
            ['stokminimum'],
            ['tinggi'],
            ['tipepenanganan'],
            ['url1'],
            ['url2'],
            ['url3'],
            ['warna'],
            ['waranty_period'],
            ['whether_cod'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('field');
    }
}
