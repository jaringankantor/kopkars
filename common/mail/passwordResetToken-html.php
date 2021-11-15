<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Hallo <?= $user->nama_lengkap ?>,</p>

    <p>Klik link di bawah ini untuk reset password:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
