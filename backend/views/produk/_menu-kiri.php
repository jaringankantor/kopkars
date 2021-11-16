<?php

use kartik\sidenav\SideNav;

$menuItems = [
    ['label' => 'List Produk', 'url' => ['/produk']],
    ['label' => 'Create Produk', 'url' => ['/produk/create']],
    ['label' => 'Import Harga & Stok', 'url' => ['/produk/import-hargastok']],
    ['label' => 'Import Foto', 'url' => ['/produk/import-foto']],
    ['label' => 'Import Deskripsi', 'url' => ['/produk/import-deskripsi']],
    [
        'label' => 'Import URL / ID',
        'items' => [
            ['label' => 'Blibli', 'url' => ['/produk/import-urlid-blibli']],
            ['label' => 'Bukalapak', 'url' => ['/produk/import-urlid-bukalapak']],
            ['label' => 'Lazada', 'url' => ['/produk/import-urlid-lazada']],
            ['label' => 'Shopee', 'url' => ['/produk/import-urlid-shopee']],
            ['label' => 'Tokopedia', 'url' => ['/produk/import-urlid-tokopedia']],
        ],
    ],
    ['label' => 'Import Tambah Produk', 'url' => ['/produk/import-tambah-produk']],
];

echo SideNav::widget([
    'type' => SideNav::TYPE_DEFAULT,
    'heading' => 'Manajemen Produk',
    'items' => $menuItems
]);