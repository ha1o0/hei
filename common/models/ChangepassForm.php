<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\Session;
use yii\helpers\Html;
use common\models\User;
use yii\helpers\ArrayHelper;

class ChangepassForm extends Model{
	public $password;
	public $newpassword;

	public function rules(){

		return[
			['password', 'required', 'message' => '密码不能为空哦'],
            ['password', 'string', 'min' => 6, 'max' => 20, 'tooLong'=>'密码的长度为6-20位字符哦', 'tooShort'=>'密码的长度为6-20位字符哦'],
            ['newpassword', 'required', 'message' => '密码不能为空哦'],
            ['newpassword', 'string', 'min' => 6, 'max' => 20, 'tooLong'=>'密码的长度为6-20位字符哦', 'tooShort'=>'密码的长度为6-20位字符哦'],
		];
	}

	public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($this->password, yii::$app->user->identity->password_hash);
    }
    public function setPassword($password)
    {
        return Yii::$app->security->generatePasswordHash($password);
    }
	public function changepass(){
		if ($this->validate()) {
			if ($this->validatePassword($this->password)){
				User::updateAll(['password_hash'=>$this->setPassword($this->newpassword)],'id=:uid',[':uid'=>yii::$app->user->identity->id]);
				User::updateAll(['password'=>$this->newpassword],'id=:uid',[':uid'=>yii::$app->user->identity->id]);
				Yii::$app->user->logout();
			   	echo "<script>alert('密码修改成功!请重新登陆！');</script>";
			   	header("refresh:1; url=?r=hei/login");
			} else {
			    echo "<script>alert('对不起，密码输入不正确！');</script>";
			    header("refresh:1; url=?r=hei/setting");
			}
		}

	}

}
