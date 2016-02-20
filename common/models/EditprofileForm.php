<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\Session;
use yii\helpers\Html;
use common\models\User;
use common\models\Userinfo;
use common\models\Cities;
use yii\helpers\ArrayHelper;
ini_set('date.timezone','PRC');

/**
* 
*/

class EditprofileForm extends Model{
	public $truename;
	public $gender;
	public $qq;
	public $weixin;
	public $phone;
	public $address;
	public $hobby;
	public $university;
	public $birthday;
	public $provinceid;
	public $cityid;
	public $areaid;
	function rules(){
		return [
            ['truename', 'string', 'max'=>8, 'message' => '姓名最长8位哦'],
            ['gender','required','message'=>'请选择性别'],
			['qq','required','message' => '请填写qq号哦'],
            ['weixin','required','message' => '请填写微信号哦'],
            ['phone','required','message' => '请填写联系电话哦'],
            ['address','required','message' => '请填写地址哦'],
            ['hobby','required','message' => '请填写兴趣爱好哦'],
            ['university','required'],
            ['birthday','required','message' => '请填写生日哦'],
            ['provinceid','required'],
            ['cityid','filter', 'filter' => 'trim'],
            ['areaid','filter', 'filter' => 'trim'],
        ];
	}
	function getProvinceList()
    {
        $data = Provinces::find()->asArray()->all();
        return ArrayHelper::map($data, 'provinceid', 'province');
    }
    function getCityList($pid)
    {
        $data = Cities::find()->where(['provinceid'=>$pid])->asArray()->all();
        return ArrayHelper::map($data, 'cityid', 'city');
    }
    function getAreaList($pid)
    {
        $data = Areas::find()->where(['cityid'=>$pid])->asArray()->all();
        return ArrayHelper::map($data, 'areaid', 'area');
    }
	function wuserinfo(){
		if ($this->validate()) {
			$userinfo1 = Userinfo::find()->where(['uid'=>yii::$app->user->identity->id])->asArray()->one();
			$usermodel = Userinfo::find()->where(['uid'=>yii::$app->user->identity->id])->asArray()->one();
			if($usermodel!=null){
				Userinfo::updateAll(['truename'=>$this->truename],'uid=:uid',[':uid'=>yii::$app->user->identity->id]);
				Userinfo::updateAll(['gender'=>$this->gender],'uid=:uid',[':uid'=>yii::$app->user->identity->id]);
				Userinfo::updateAll(['hobby'=>$this->hobby],'uid=:uid',[':uid'=>yii::$app->user->identity->id]);
				Userinfo::updateAll(['birthday'=>$this->birthday],'uid=:uid',[':uid'=>yii::$app->user->identity->id]);
				Userinfo::updateAll(['university'=>$this->university],'uid=:uid',[':uid'=>yii::$app->user->identity->id]);
				Userinfo::updateAll(['phone'=>$this->phone],'uid=:uid',[':uid'=>yii::$app->user->identity->id]);
				Userinfo::updateAll(['qq'=>$this->qq],'uid=:uid',[':uid'=>yii::$app->user->identity->id]);
				Userinfo::updateAll(['weixin'=>$this->weixin],'uid=:uid',[':uid'=>yii::$app->user->identity->id]);
				Userinfo::updateAll(['provinceid'=>$this->provinceid],'uid=:uid',[':uid'=>yii::$app->user->identity->id]);
				if($this->cityid != null){
					Userinfo::updateAll(['cityid'=>$this->cityid],'uid=:uid',[':uid'=>yii::$app->user->identity->id]);
				}else{
					Userinfo::updateAll(['cityid'=>$userinfo1['cityid']],'uid=:uid',[':uid'=>yii::$app->user->identity->id]);
				}
				if($this->areaid != null){
					Userinfo::updateAll(['areaid'=>$this->areaid],'uid=:uid',[':uid'=>yii::$app->user->identity->id]);
				}else{
					Userinfo::updateAll(['areaid'=>$userinfo1['areaid']],'uid=:uid',[':uid'=>yii::$app->user->identity->id]);
				}
				Userinfo::updateAll(['address'=>$this->address],'uid=:uid',[':uid'=>yii::$app->user->identity->id]);
				header("refresh:0;url = ?r=hei/editprofile");
			}else{
				$userinfo = new Userinfo();
				$userinfo->uid = yii::$app->user->identity->id;
				$userinfo->truename=$this->truename;
				$userinfo->gender=$this->gender;
				$userinfo->hobby=$this->hobby;
				$userinfo->birthday=$this->birthday;
				$userinfo->university=$this->university;
				$userinfo->phone=$this->phone;
				$userinfo->qq=$this->qq;
				$userinfo->weixin=$this->weixin;
				$userinfo->provinceid=$this->provinceid;
				$userinfo->cityid=$this->cityid;
				$userinfo->areaid=$this->areaid;
				$userinfo->address=$this->address;
				$userinfo->save();
				header("refresh:0;url = ?r=hei/editprofile");
			}	
		}
	}
}