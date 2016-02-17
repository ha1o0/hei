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
$this->title = '登录';
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
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4 " style="width:300px; color:white">
                <div class="row">
                    <div class="col-lg-12 col-lg-offset-3">
                        <div class="container-fluid" id="loginimg">
                            <img src="./img/m3.jpg" alt="" class="img-circle"><br>
                        </div><br><br>
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                            <?= $form->field($model, 'username')->label('用 户 名 / 邮 箱') ?>

                            <?= $form->field($model, 'password')->passwordInput()->label('密 码')  ?>

                            <?= $form->field($model, 'rememberMe')->checkbox()->label('记 住 我') ?>

                            <div style="color:white;margin:1em 0">
                                如果忘记了密码您可以<?= Html::a('重置', ['hei/request-password-reset']) ?>.
                            </div>

                            <div class="form-group">
                                <?= Html::submitButton('登  录', ['class' => 'btn', 'name' => 'login-button', 'id' => 'login22', 'onclick'=>'loginclick()']) ?>
                            </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="./assets/bootstrap.min.js"></script>
<script src="./assets/jquery.min.js"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

