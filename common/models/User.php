<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_default
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
* @property string|null $skuprefix1
 * @property string|null $skuprefix2
 * @property string|null $skuprefix3
 * @property string|null $skuprefix4
 * @property string|null $skuprefix5
 * @property string|null $skuprefix6
 * @property string|null $skuprefix7
 * @property string|null $skuprefix8
 * @property string|null $skuprefix9
 * @property string|null $skuprefix10
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public $username;
	public $re_password;
	public $captcha;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            //if ($this->isNewRecord) {
                $this->generateAuthKey();
                $this->setPassword($this->password_default);
            //}
            return true;
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_toko','email','password_default','re_password'], 'required'],
            ['kode_toko', 'string', 'max' => 50],
            ['kode_toko', 'match' ,'pattern'=>'/^[A-Za-z0-9._-]+$/u','message'=> 'Only alphanumeric, dot(.), underscore(_), and hypen(-)'],
            ['email', 'email'],
            ['re_password', 'compare', 'compareAttribute'=>'password_default', 'skipOnEmpty' => false, 'message'=>'Re-Password aplikasi tidak sama'],
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash','password_reset_token'], 'string', 'max' => 255],
            [['skuprefix1', 'skuprefix2', 'skuprefix3', 'skuprefix4', 'skuprefix5', 'skuprefix6', 'skuprefix7', 'skuprefix8', 'skuprefix9', 'skuprefix10'], 'string', 'max' => 10],
            [['email'], 'unique'],
            ['captcha', 'captcha']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode_toko' => 'Kode Toko',
            'status_aktif' => 'Status Aktif',
            'email' => 'Email',
            'password_default' => 'Password',
            're_password' => 'Ulangi Password',
            'skuprefix1' => 'SKU Prefix1',
            'skuprefix2' => 'SKU Prefix2',
            'skuprefix3' => 'SKU Prefix3',
            'skuprefix4' => 'SKU Prefix4',
            'skuprefix5' => 'SKU Prefix5',
            'skuprefix6' => 'SKU Prefix6',
            'skuprefix7' => 'SKU Prefix7',
            'skuprefix8' => 'SKU Prefix8',
            'skuprefix9' => 'SKU Prefix9',
            'skuprefix10' => 'SKU Prefix10',
        ];
    }

    public static function findUser()
    {
        return self::find()
            ->where(['kode_toko'=>Yii::$app->user->identity->kode_toko]);
    }

    public static function findOneUser($email)
    {
        return self::findUser()
            ->andWhere(['email'=>$email])
            ->one();
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByEmailAssignment($email)
    {
        return static::find(['email' => $email, 'status_aktif' => self::STATUS_ACTIVE])->innerJoin('auth_assignment', 'user.id = auth_assignment.user_id::integer')->one();
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getKodeToko()
    {
        return $this->hasOne(Toko::className(), ['kode' => 'kode_toko']);
    }
}
