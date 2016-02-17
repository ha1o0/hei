<?php
namespace common\models;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
use Yii;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\web\Session;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\User;
use common\models\StateForm;
use common\models\State;
use common\models\Statement;
use common\models\Userinfo;
use common\models\Provinces;
use common\models\Cities;
use common\models\Areas;
use common\models\EditprofileForm;
AppAsset::register($this);
$this->title = '编辑主页';
// $this->params['breadcrumbs'][] = $this->title;
?>
<?php
	$userinfo = Userinfo::find()->where(['uid'=>yii::$app->user->identity->id])->asArray()->one();
	$pro = Provinces::find()->where(['provinceid'=>$userinfo['provinceid']])->asArray()->one();
	$cit = Cities::find()->where(['cityid'=>$userinfo['cityid']])->asArray()->one();
	$are = Areas::find()->where(['areaid'=>$userinfo['areaid']])->asArray()->one();
?>
<div class="col-lg-12 col-lg-offset-5">
	<h2>修改个人信息</h2><br>
</div>
<div class="container-fluid">
<?php $form=ActiveForm::begin(['action'=>'?r=hei/profilesave','method'=>'post'])?>
	<div class="col-lg-4 col-lg-offset-3 form-group">
		<label for="">真实姓名：<?= $form->field($model,'truename')->textinput(['value'=>$userinfo['truename']])->label(false)?></label><br>
		<label for="">性别：<?= $form->field($model,'gender')->radioList(['1'=>'男','2'=>'女'])->label(false)?></label><br>
		<label for="">生日：<?= $form->field($model,'birthday')->textinput(['value'=>$userinfo['birthday']])->label(false)?></label><br>
		<label for="">毕业学校：<?= $form->field($model,'university')->textinput(['value'=>$userinfo['university']])->label(false)?></label><br>
		<label for="">兴趣爱好：<?= $form->field($model,'hobby')->textarea(['cols'=>22,'value'=>$userinfo['hobby']])->label(false)?></label><br>
	</div>
	<div class="form-group">
		<label for="">联系电话：<?= $form->field($model,'phone')->textinput(['value'=>$userinfo['phone']])->label(false)?></label><br>
		<label for="">qq：<?= $form->field($model,'qq')->textinput(['value'=>$userinfo['qq']])->label(false)?></label><br>
		<label for="">微信：<?= $form->field($model,'weixin')->textinput(['value'=>$userinfo['weixin']])->label(false)?></label><br>
		<label><?= $form->field($model,'provinceid')->dropDownList($model->getProvinceList(),
	    [
	    	'id'=>'user-provinces',
	        'prompt'=>$pro['province'],
	        'onclick'=>'
	            $.post("?r=hei/city",{pid:$("#user-provinces").val()},function(data){  
	            $("#user-citys").html(data);  
	            $("#user-areas").html(" ");
            });',
	    ])->label('地址：') ?></label>
		<label><?= $form->field($model,'cityid')->dropDownList($model->getCityList(0),
		[	 
			 'id'=>'user-citys',
		     'prompt'=>$cit['city'],
		     'onclick'=>' 
			    $.post("?r=hei/area",{cid:$("#user-citys").val()},function(data){
	            $("#user-areas").html(data);
			});',
		])->label(false) ?></label>
		<label><?= $form->field($model,'areaid')->dropDownList($model->getAreaList(0),
		[
			'id'=>'user-areas', 
			'prompt'=>$are['area'],
		])->label(false) ?></label><br>
		<label><?= $form->field($model,'address')->textarea(['cols'=>35,'value'=>$userinfo['address'],'placeholder'=>'请填写具体地址'])->label(false)?></label>
	</div>
	<div class="form-group">
	    <?= Html::submitButton('保存', ['class' => 'btn', 'id' => 'login2']) ?>
	</div>
<?php ActiveForm::end()?>
</div>
<script src="./assets/bootstrap.min.js"></script>
<script src="./assets/jquery.min.js"></script>
<script src="./assets/jquery.goup.min.js"></script>
<script src="./assets/index.js"></script>