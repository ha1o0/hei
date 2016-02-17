<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;
ini_set('date.timezone','PRC');
/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $repassword;
    public $registertime;
    public $registerip;
    public $agree = true;
    public $password_hash;
    public $auth_key;
    public $status;
    public $created_at;
    public $updated_at;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required', 'message' => '用户名不能为空哦'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '对不起该用户名已被注册哦'],
            ['username', 'match','pattern'=>'/^[a-z0-9_\x{4e00}-\x{9fa5}]{6,20}$/u', 'message'=>'用户名为6-20个字符哦,只可以包含字母、数字、汉字和下划线哦'],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required', 'message' => '邮箱不能为空哦'],
            ['email', 'email'],
            ['email', 'string', 'max' => 45],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => '对不起该邮箱已被注册哦'],

            ['password', 'required', 'message' => '密码不能为空哦'],
            ['password', 'string', 'min' => 6, 'max' => 20, 'tooLong'=>'密码的长度为6-20位字符哦', 'tooShort'=>'密码的长度为6-20位字符哦'],
            ['password', 'compare', 'compareAttribute'=>'repassword', 'message' => '两次密码输入不一致哦'],

            ['repassword', 'compare', 'compareAttribute'=>'password', 'message' => '两次密码输入不一致哦'],

            ['agree', 'required', 'requiredValue' => true, 'message' => '请确认同意本站注册协议才可以哦' ]
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->password = $this->password;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->registertime = date('Y-m-d H:i:s',time());
            $user->registerip = Yii::$app->request->userIP;
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
