<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\Session;
use common\models\User;
use common\models\State;

ini_set('date.timezone','PRC');

/**
* 
*/
class StateForm extends Model{
	
	
	public $content;
    public $time;
    public $solved = 0;
    public $uid;
	function rules(){
		return [
            ['content', 'required', 'message' => '字数不能为空哦'], 
            ['content', 'string', 'max' => 250, 'tooLong'=>'字数不能超过250哦'],
        ];
	}


	public function wcontent(){
		if ($this->validate()) {
            $state = new State();
            if (!\Yii::$app->user->isGuest) {
            	$state->uid = Yii::$app->user->identity->id;
            }else{
				exit;
            }
            $state->time = date('Y-m-d H:i:s',time());
            $state->content = $this->content;
            $state->ip = Yii::$app->request->userIP;
			$state->save();
			//header("refresh:0;url = ?r=hei/index");
        }

        return null;
	}

	public function sdelete(){
		$statede = State::find()->where(['id'=>90])->asArray()->one();
		if (!\Yii::$app->user->isGuest) {
				if ($statede!=null){
					$statede->delete(); 
				}
				else{
					echo "<script language=javascript>
					alert('对不起找不到该状态！');
					</script>";
					exit;
				}
            }else{
            	echo "<script language=javascript>
				alert('您还未登录！请登录后操作哦');
				</script>";
				header("refresh:2;url = ?r=hei/login");
				exit;
            }
	}
	
}
?>