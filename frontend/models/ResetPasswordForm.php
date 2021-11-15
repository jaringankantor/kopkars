<?php
namespace frontend\models;

use yii\base\InvalidArgumentException;
use yii\base\Model;
use Yii;
use common\models\Anggota;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;
    public $re_password;
    public $captcha;

    private $_user;


    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws InvalidArgumentException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Password reset token cannot be blank.');
        }
        $this->_user = Anggota::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new InvalidArgumentException('Wrong password reset token.');
        }
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['password','re_password','captcha'], 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            ['re_password', 'compare', 'compareAttribute'=>'password', 'skipOnEmpty' => false, 'message'=>'Re-Password aplikasi tidak sama'],
            ['captcha', 'captcha']
            
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        $user->generateAuthKey();

        return $user->save(false);
    }
}
