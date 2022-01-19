<?php


namespace frontend\models;

use Yii;
use common\models\Anggota;
use yii\base\Model;

class ResendVerificationEmailForm extends Model
{
    /**
     * @var string
     */
    public $email;
    public $captcha;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\Anggota',
                'filter' => ['kode_toko'=>Yii::$app->params['kode_toko'],'email_last_lock_verified' => Anggota::EMAIL_NOT_VERIFIED],
                'message' => 'Email tidak ditemukan untuk proses verifikasi.'
            ],
            ['captcha', 'captcha']
        ];
    }

    /**
     * Sends confirmation email to user
     *
     * @return bool whether the email was sent
     */
    public function sendEmail()
    {
        $anggota = Anggota::findOne([
            'email_last_lock' => $this->email,
            'kode_toko'=>Yii::$app->params['kode_toko']
            //'status' => Anggota::STATUS_NULL
        ]);

        if ($anggota === null) {
            return false;
        }

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $anggota]
            )
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->name . ' no-replay'])
            ->setTo($this->email)
            ->setSubject('Kirim Ulang Verifikasi Email ' . Yii::$app->name)
            ->send();
    }
}
