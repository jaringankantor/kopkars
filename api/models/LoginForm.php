<?php
namespace api\models;

use Yii;
use common\models\Anggota;
use frontend\models\LoginForm as FrontendLoginForm;

class LoginForm extends FrontendLoginForm {

    private $_user;

    Const EXPIRE_TIME = 604800; //token expiration time, 7 days valid

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['default'] = [];
        $scenarios['api-login-user'] = ['email', 'password'];
        return $scenarios;
    }

    public function login()
    {
        if ($this->validate()) {
            //return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
            if ($this->getUser()) {
                $user = $this->_user;
                $user->scenario = 'api-set-token';
                $access_token = $user->generateAccessToken();
                $user->expire_at = time() + static::EXPIRE_TIME;
                $user->save();
                Yii::$app->user->login($this->getUser(), static::EXPIRE_TIME);
                return $access_token;
            }
        }
        return false;
    }

    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Anggota::findByEmail($this->email);
        }

        return $this->_user;
    }
}