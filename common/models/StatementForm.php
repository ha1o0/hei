<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\Session;
use common\models\User;
use common\models\State;
use common\models\Statement;

ini_set('date.timezone','PRC');

/**
* 
*/
class StatementForm extends Model{
	
	
	public $scomment;
    public $sctime;
    public $sid;
    public $sip;
    public $scid;
	function rules(){
		return [
            [['scomment', 'scid'], 'required', 'message' => ''], 
        ];
	}


	public function wcomment(){
		if ($this->validate()) {
            $statement = new Statement();
            if (!\Yii::$app->user->isGuest) {
            	$statement->sid = Yii::$app->user->identity->id;
            }else{
            	echo "<script language=javascript>
				alert('您还未登录！请登录后操作哦');
				</script>";
				header("refresh:2;url=?r=hei/login");
				exit;
            }
            $statement->sctime = date('Y-m-d H:i:s',time());
            $statement->scomment = $this->scomment;
            $statement->sip = Yii::$app->request->userIP;
            $statement->scid = $this->scid;
			$statement->save();
			header("refresh:0;url=?r=hei/index");
        }

        return null;
	}

	// public function FindUid(){

	// }
	
}
?>