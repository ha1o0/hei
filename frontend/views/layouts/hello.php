<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
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
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
