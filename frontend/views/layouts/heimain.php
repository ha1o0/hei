<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\web\Session;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\User;
AppAsset::register($this);
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
    <script src="./assets/index.js"></script>
    <link rel="stylesheet" href="./css/hello.css">
    <link rel="stylesheet" href="./css/dropify.min.css">
    <link rel="stylesheet" href="./css/normalize.css" />
    <link rel="stylesheet" href="./css/default.css">
    <link rel="stylesheet" href="./css/demo.css">
    <link href='http://fonts.useso.com/css?family=Roboto:400,300,700,900|Roboto+Condensed:400,300,700' rel='stylesheet' type='text/css'>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body style="background-color: #f8f8ff">
<?php $this->beginBody() ?>
<div style="background-color: coral; height:65px">
  <nav class="navbar navbar-Coral">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="?r=hei/index"><img alt="嘿嘿" src="./img/logom.png"></a>
      </div> 
      <div id="searchform">
        <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="搜索">
            </div>
            <button type="submit" class="btn btn-default">搜索</button>
        </form>
      </div>
      <div class="col-lg-1 col-lg-offset-7" id="tx">
        
          <?php if (isset(Yii::$app->user->identity->username)) {
            $urlid = Yii::$app->user->identity->id;
           echo "<a class=\"navbar-brand\" href=\"?r=hei/profile&uid=$urlid\"><img alt=\"嘿嘿\" src=\"./img/3030.png\" class=\"img-rounded\"></a>";
          } else{
            echo "<a href=\"?r=hei/login\"><h4 style=\"color:white;\">登录</h4></a><a href=\"?r=hei/signup\"><h4 style=\"color:white;\">注册</h4></a>";
            }?>
        
        <div class="col-lg-10 col-lg-offset-3" id="txname">
          <a href="?r=hei/profile&uid=<?php echo $urlid; ?>"><h3 style="color:white"><?php echo Yii::$app->user->identity->username;?></h3></a>
        </div>
      </div>
      <ul class="nav navbar-nav navbar-right">
          <li class="dropdown navbar-brand" id="lidropdown">
              <div class="btn dropdown-toggle" data-toggle="dropdown" style="margin-left:-51px">
              <img alt="menu" id="menu" src="./img/sangangy.png">
              </div>
              <ul class="dropdown-menu" role="dropdown" id="navul">
                  <li><a href="?r=hei/setting">设置</a></li>
                  <li><a href="">联系我们</a></li>
                  <?php if (isset(Yii::$app->user->identity->username)) {
                    echo "<li><a href=\"?r=hei/logout\">退出账号</a></li>";
                  }
                  ?>
              </ul>
              
          </li>
      </ul>
    </div>
  </nav>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>