<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);
?>
Hallo <?= $user->nama_lengkap ?>,

Klik link di bawah ini, setelah itu mohon memperbaharui biodata:

<?= $verifyLink ?>

Terima kasih