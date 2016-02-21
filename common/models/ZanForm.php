<?php 
namespace common\models;

use yii;
use yii\helpers\Html;
use yii\base\Model;
use common\models\User;
use common\models\Useinfo;
use common\models\State;
use common\models\Zan;

/**
* 
*/
class ZanForm extends Model
{
	public function zans($i){
		
		if (\yii::$app->user->isGuest) {
			$zanif = Zan::find()->andWhere(['zanip'=>Yii::$app->request->userIP, 'sid'=>$i])->asArray()->one();
		}else{
			$zanif = Zan::find()->andWhere(['uid'=>yii::$app->user->identity->id, 'sid'=>$i])->asArray()->one();
		}
		if ($zanif != null) {
				exit;
		}else{
			$zan = new Zan();
			if (\yii::$app->user->isGuest){
				$zan->uid = 0;
			}else{
				$zan->uid = yii::$app->user->identity->id;
			}
			$zan->sid = $i;
			$zan->time = date('Y-m-d H:i:s',time());
			$zan->zanip = Yii::$app->request->userIP;
			$zan->save();
		}
	}
}
