<?php

/* @var $this yii\web\View */

$this->title = 'Admin';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Hallo, <?=Yii::$app->user->identity->kode_toko?>!</h1>

        <p class="lead">Selamat datang di halaman admin KOPKARS Politeknik Negeri Jakarta</p>

        <p><a class="btn btn-lg btn-success" href="<?php echo yii\helpers\Url::toRoute('anggota/index')?>">Manajemen Anggota</a></p>
    </div>
</div>
