<?php
namespace frontend\controllers;

use common\models\Anggota;
use common\models\DbpegawaiPubPegawai;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','registrasi','login', 'error','captcha','request-password-reset','reset-password','resend-verification-email','verify-email'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['anggota/biodata']);
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Creates a new Anggota model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionRegistrasi()
    {
        if(!Yii::$app->user->isGuest) return $this->redirect(['anggota/biodata']);
        
        $model = new Anggota();
        $model->scenario = 'frontend-create-anggota';

        if ($model->load(Yii::$app->request->post())) {
            $model->kode_toko = Yii::$app->params['kode_toko'];
            $model->setPassword($model->password_default);
            $model->generateAuthKey();
            $model->generateEmailVerificationToken();

            $model->nomor_hp = preg_replace('/[^0-9]/', '', $model->nomor_hp);

            $db_pegawai_pub_pegawai = DbpegawaiPubPegawai::find()->where(['pegKodeResmi'=>$model->nomor_pegawai])->one();
            $model->nomor_ktp = preg_replace('/[^0-9]/', '', $db_pegawai_pub_pegawai->pegIdLain);
            $model->nama_lengkap = $db_pegawai_pub_pegawai->pegNama;
            $model->tempat_lahir = $db_pegawai_pub_pegawai->pegTmpLahir;
            $model->tanggal_lahir = $db_pegawai_pub_pegawai->pegTglLahir;
            $model->jenis_kelamin = $db_pegawai_pub_pegawai->pegKelamin;
            $agama_id = $db_pegawai_pub_pegawai->pegAgamaId;

            switch ($agama_id) {
                case 1:
                    $agama = 'ISLAM';
                    break;
                case 2:
                    $agama = 'KRISTEN';
                    break;
                case 7:
                    $agama = 'HINDU';
                    break;
                case 13:
                    $agama = 'BUDHA';
                    break;
                case 14:
                    $agama = 'KATOLIK';
                    break;
                case 15:
                    $agama = 'KRISTEN';
                    break;
                default:
                    $agama = NULL;
                    break;
            }

            $model->agama = $agama;
            $model->alamat_rumah = $db_pegawai_pub_pegawai->pegAlamat.' '.$db_pegawai_pub_pegawai->pegDesaRumah.' '.$db_pegawai_pub_pegawai->pegKecRumah.' '.$db_pegawai_pub_pegawai->pegKotaRumah.' '.$db_pegawai_pub_pegawai->pegProvinsiRumah;
            $model->nomor_npwp = preg_replace('/[^0-9]/', '', $db_pegawai_pub_pegawai->pegNoNPWP);

            if($model->save() && $model->sendEmail($model)) {
                Yii::$app->session->setFlash('success', 'Pendaftaran sukses, silahkan membuka email lalu klik link verifikasi pada email yang kami kirimkan.');
                return $this->goHome();
            } 
            //else {
            //    echo "MODEL NOT SAVED";
            //    print_r($model->getAttributes());
            //    print_r($model->getErrors());
            //    exit;
            //}

        }

        return $this->render('@frontend/views/anggota/registrasi', [
            'model' => $model,
        ]);
    }

    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail())&&Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Mohon segera memperbaharui biodata Anda');
            return $this->redirect(['anggota/update']);
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }
    
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Silahkan membuka email lalu klik link verifikasi pada email.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Silahkan ikuti instruksi pada email untuk reset password.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
