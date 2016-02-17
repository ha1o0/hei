<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
AppAsset::register($this);
$this->title = '注册';
// $this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="./assets/bootstrap.min.js"></script>
    <script src="./assets/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/hello.css">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body style="background-color: coral">
<?php $this->beginBody() ?>
<nav class="navbar navbar-Coral">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="?r=hei/welcom"><img alt="嘿嘿" src="./img/logom.png"></a>
    </div> 
      <ul class="nav navbar-nav navbar-right">
        <div class="btn-group navbar-brand">
            <button id="navbutton" class="btn dropdown-toggle" data-toggle="dropdown">
                <img alt="menu"  id="menu" src="./img/sangangy.png" >
            </button>
            <ul class="dropdown-menu" role="dropdown">
                <li><a href="#">关于</a></li>
                <li><a href="#">联系我们</a></li>
            </ul>
        </div>
      </ul>
  </div>
</nav>
<div class="text-center">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4" style="color:white; width:300px">
                <div class="col-lg-12 col-lg-offset-3" id="formfont">
                    <h2 style="color:white">开启一个新用户</h2><br>
                    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                        <?= $form->field($model, 'username')->label('用 户 名')?>

                        <?= $form->field($model, 'email')->label('邮 箱') ?>

                        <?= $form->field($model, 'password')->passwordInput()->label('密 码') ?>

                        <?= $form->field($model, 'repassword')->passwordInput()->label('重 复 密 码')  ?>

                        <?= $form->field($model, 'agree')->checkbox()->label('同意本站协议') ?>
                        <br>
                        <div class="form-group">
                            <?= Html::submitButton('注 册', ['class' => 'btn', 'name' => 'signup-button', 'id' => 'login22']) ?>
                        </div>
                    
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
    <hr size=100 width="1" color="#999999"></hr>
</div>
<script src="./assets/bootstrap.min.js"></script>
<script src="./assets/jquery.min.js"></script>
<script>
         $(document).ready(function(){
         dropdownOpen();//调用
     });
     /**
      * 鼠标划过就展开子菜单，免得需要点击才能展开
      */
     function dropdownOpen() {    
         var $dropdownLi = $('li.dropdown');
       $dropdownLi.mouseover(function() {
             document.getElementById('menu').style.transform="rotate(90deg)";
             $(this).addClass('open');          
         }).mouseout(function() {
             document.getElementById('menu').style.transform="rotate(0deg)";
             $(this).removeClass('open');
         });
     }
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>