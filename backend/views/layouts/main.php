<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use kartik\nav\NavX;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div  class="container-fluid" style="margin-top:60px">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'innerContainerOptions' => ['class' => 'container-fluid'],
        'options' => [
            'class' => 'navbar navbar-default navbar-fixed-top',
        ],
    ]);

    $menuItems = [];

    if (Yii::$app->user->can('All Pengaturan Sistem') OR Yii::$app->user->can('All Sistem Marketplace')) {
        if(Yii::$app->user->can('All Sistem Marketplace')) {
            $sistem[] = [
                'label' => 'Marketplace',
                'items' => [
                    ['label' => 'Market Place', 'url' => ['/variabel-marketplace']],
                    ['label' => 'Toko', 'url' => ['/toko']],
                    ['label' => 'User', 'url' => ['/user']],
                    ['label' => 'Field', 'url' => ['/field']],
                    ['label' => 'Form', 'url' => ['/form']],
                    ['label' => 'Form Field', 'url' => ['/form-field']],
                ],
            ];
        }

        $menuItems[] =
        [
            'label' => 'Sistem',
            'items' => [
                ['label' => 'GII', 'url' => ['/gii']],
                ['label' => 'RBAC Rule', 'url' => ['/rbac/rule']],
                ['label' => 'RBAC Route', 'url' => ['/rbac/route']],
                ['label' => 'RBAC Permission', 'url' => ['/rbac/permission']],
                ['label' => 'RBAC Role', 'url' => ['/rbac/role']],
                ['label' => 'RBAC Assignment', 'url' => ['/rbac/assignment']],
                $sistem
            ]
        ];
    }

    if (Yii::$app->user->can('All Master Marketplace') OR 
    Yii::$app->user->can('All Setting Marketplace') OR Yii::$app->user->can('All Export Marketplace')) {

        if (Yii::$app->user->can('All Master Marketplace')) {
            $marketplace[] =
            [
                'label' => 'Master',
                'items' => [
                    ['label' => 'Kategori', 'url' => ['/variabel-marketplace-kategori']],
                    ['label' => 'Etalase', 'url' => ['/variabel-marketplace-etalase']],
                    ['label' => 'Produk', 'url' => ['/produk']],
                ]
            ];
        }

        if (Yii::$app->user->can('All Setting Marketplace')) {
            $marketplace[] =
            [
                'label' => 'Setting Mkp',
                'items' => [
                    ['label' => 'Blibli', 'url' => ['/setting/blibli']],
                    ['label' => 'Bukalapak', 'url' => ['/setting/bukalapak']],
                    ['label' => 'Elevenia', 'url' => ['/setting/elevenia']],
                    ['label' => 'Facebook Catalog', 'url' => ['/setting/facebook-catalog']],
                    ['label' => 'JDID', 'url' => ['/setting/jdid']],
                    ['label' => 'Lazada', 'url' => ['/setting/lazada']],
                    ['label' => 'Shopee', 'url' => ['/setting/shopee']],
                    ['label' => 'Tokopedia', 'url' => ['/setting/tokopedia']],
                    ['label' => 'Kategori Marketplace', 'url' => ['/setting/marketplace-kategori']],
                    ['label' => 'Etalase Marketplace', 'url' => ['/setting/marketplace-etalase']],
                ]
            ];
        }

        if (Yii::$app->user->can('All Export Marketplace')) {
            $marketplace[] =
            [
                'label' => 'Eksport',
                'items' => [
                    ['label' => 'Eksport Tambah', 'url' => ['/export/form-tambah']],
                    ['label' => 'Blibli: Stok dan Harga', 'url' => ['/export/update-blibli-stokharga']],
                    ['label' => 'Bukalapak: Stok, Harga, Deskripsi, Video', 'url' => ['/export/update-bukalapak-stokhargadeskripsivideo']],
                    ['label' => 'Facebook Catalog: All', 'url' => ['/export/tambah-facebook-catalog']],
                    ['label' => 'Lazada: Deskripsi dan Gambar (saat ini hanya deskripsi saja)', 'url' => ['/export/update-lazada-deskripsi-gambar']],
                    ['label' => 'Lazada: Stok dan Harga', 'url' => ['/export/update-lazada-stokharga']],
                    ['label' => 'Shopee: Deskripsi', 'url' => ['/export/update-shopee-deskripsi']],
                    ['label' => 'Shopee: Stok dan Harga', 'url' => ['/export/update-shopee-stokharga']],
                    ['label' => 'Tokopedia: Deskripsi, Gambar, Video (saat ini hanya deskripsi dan video saja)', 'url' => ['/export/update-tokopedia-deskripsi-gambar-video']],
                    ['label' => 'Tokopedia: Stok dan Harga', 'url' => ['/export/update-tokopedia-stokharga']],
                ]
            ];
        }

        $menuItems[] =
        [
            'label' => 'Marketplace',
            'items'=> $marketplace
        ];
    }

    if (Yii::$app->user->can('All Manajemen Anggota')) {
        $menuItems[] =
        [
            'label' => 'Manajemen Anggota',
            'items' => [
                ['label' => 'Pemberian Nomor', 'url' => ['/anggota/beri-nomor']],
                ['label' => 'Anggota', 'url' => ['/anggota/index']],
                ['label' => 'Histori Anggota', 'url' => ['/anggota/histori']],
            ],
        ];
    }

    if (Yii::$app->user->can('All Anggota Simpanan')) {
        $menuItems[] =
        [
            'label' => 'Simpanan Anggota',
            'items' => [
                ['label' => 'List Simpanan Anggota', 'url' => ['/anggota-simpanan']],
            ],
        ];
    }

    if (Yii::$app->user->can('All Pinjaman')) {
        $menuItems[] =
        [
            'label' => 'Pinjaman',
            'items' => [
                ['label' => 'List Pinjaman', 'url' => ['/pinjaman/index']],
            ],
        ];
    }

    if (Yii::$app->user->can('All Cicilan')) {
        $menuItems[] =
        [
            'label' => 'Cicilan',
            'items' => [
                ['label' => 'List Cicilan', 'url' => ['/cicilan/index']],
            ],
        ];
    }

    if (Yii::$app->user->can('All Transaksi')) {
        $menuItems[] =
        [
            'label' => 'Transaksi',
            'items' => [
                ['label' => 'List Transaksi', 'url' => ['/transaksi']],
                ['label' => 'Import Transaksi Lazada', 'url' => ['/transaksi/import-lazada']],
                ['label' => 'Import Transaksi Tokopedia', 'url' => ['/transaksi/import-tokopedia']],
                ['label' => 'Import Transaksi Zahir', 'url' => ['/transaksi/import-zahir']],
            ],
        ];
    }

    if (Yii::$app->user->can('All Voucher')) {
        $menuItems[] =
        [
            'label' => 'Voucher',
            'items' => [
                ['label' => 'List Voucher', 'url' => ['/voucher/index']],
            ],
        ];
    }

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                //'Logout (' . Yii::$app->user->identity->email . ')',
                'Logout',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo NavX::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container-fluid">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container-fluid">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right">Powered by <?=Html::a('PNJ','https://pnj.ac.id/')?> and <?=Html::a('JaringanKantor','https://www.jaringankantor.com/')?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
