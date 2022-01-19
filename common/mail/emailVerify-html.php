<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $anggota->verification_token]);
?>
<div class="verify-email">
    <p>Hallo <?= Html::encode($anggota->nama_lengkap) ?>,</p>

    <p>Klik link di bawah ini, setelah itu mohon memperbaharui biodata:</p>

    <p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>

    <p>Terima kasih</p>
</div>
