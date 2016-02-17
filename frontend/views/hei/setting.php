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
$this->title = '设置';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="container sidebar-menu">
	<a href="#userMeun" class="nav-header menu-first collapsed" data-toggle="collapse"><h3 style="color:coral">密码设置</h3></a>
	<ul id="userMeun" class="nav nav-list collapse menu-second"><br>
	<legend><h4>修改密码：</h4></legend>
		<div class="col-lg-3 col-lg-offset-1">
			<?php $form=ActiveForm::begin(['action'=>'?r=hei/changepass'])?>
				<?= $form->field($model,'password')->passwordInput()->label('请输入旧密码：')?>
				<?= $form->field($model,'newpassword')->passwordInput()->label('请输入新密码：')?>
				<div class="form-group">
                <?= Html::submitButton('确认修改！', ['class' => 'btn btn-default']) ?>
                </div>
			<?php $form=ActiveForm::end()?>
		</div>
		<div class="col-lg-9"></div>
	</ul>
	<br>
	<a href="#articleMenu" class="nav-header menu-first collapsed" data-toggle="collapse"><i class="icon-book icon-large"></i> <h3 style="color:coral">头像设置</h3></a>
	<ul id="articleMenu" class="nav nav-list collapse menu-second">
		<div class="container">
            <div class="col-lg-6">
                <label for="input-file-now">请选择头像</label>
                <input type="file" id="input-file-now" class="dropify" data-default-file="" />
            </div>
        </div>
	</ul>
</div>

<script src="./assets/bootstrap.min.js"></script>
<script src="./assets/jquery.min.js"></script>
<script src="./assets/jquery.goup.min.js"></script>
<script src="./assets/index.js"></script>
<script src="./assets/dist/js/dropify.min.js"></script> 

<script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
<script>
    $(document).ready(function(){

        // Translated
        $('.dropify-fr').dropify({
            messages: {
            'default': '点击或拖拽文件到这里',
	        'replace': '点击或拖拽文件到这里来替换文件',
	        'remove':  '移除文件',
	        'error':   '对不起，你上传的文件太大了'
            }
        });

        // Used events
        var drEvent = $('.dropify-event').dropify();

        drEvent.on('dropify.beforeClear', function(event, element){
            return confirm("Do you really want to delete \"" + element.filename + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element){
            alert('File deleted');
        });
    });
</script>