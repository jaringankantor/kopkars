<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Anggota;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;
    public $captcha;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            [['email','captcha'], 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\Anggota',
                'filter' => ['email_last_lock_verified' => Anggota::EMAIL_VERIFIED],
                'message' => 'Email tidak ditemukan atau belum diverifikasi.'
            ],
            ['captcha', 'captcha']
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        $anggota = Anggota::find([
            //'kode_toko'=>Yii::$app->params['kode_toko'],
            'email_last_lock' => $this->email,
            'email_last_lock_verified' => Anggota::EMAIL_VERIFIED
        ]);

        if (!$anggota) {
            return false;
        }
        
        if (!Anggota::isPasswordResetTokenValid($anggota->password_reset_token)) {
            $anggota->generatePasswordResetToken();
            if (!$anggota->save()) {
                return false;
            }
        }

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $anggota]
            )
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->name . ' no-replay'])
            ->setTo($this->email)
            ->setSubject('Permintaan Reset Password ' . Yii::$app->name)
            ->send();
    }
}
