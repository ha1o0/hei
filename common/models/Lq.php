<?php
namespace common\models;

use yii;
use yii\base\Model;
use common\models\Help;
use common\models\State;

/**
* 
*/
class Lq extends Model
{
	public function lq($i){
		$lqif = State::find()->where(['id'=>$i])->asArray()->one();
		if (\yii::$app->user->isGuest || ($lqif['solved']!=0)) {
			exit;
		}else{
			$lq = new Help();
			$lq->helperuid = yii::$app->user->identity->id;
			$lq->helptime = date('Y-m-d H:i:s',time());
			$lq->helpip = yii::$app->request->userIP;
			$lq->sid = $i;
			$lq->save();

			State::updateAll(['solved'=>1],'id=:sid',['sid'=>$i]);
		}
	}
}