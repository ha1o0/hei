<?php
namespace common\models;

use yii;
use yii\base\Model;
use yii\web\Session;
use yii\helpers\Html;
use common\models\User;
use common\models\Userinfo;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class uploadForm extends Model{
	public $file;
	public function rule(){
		return[
			[['file'], 'file'],

		];
	}

	public function savepicture(){

	}
}