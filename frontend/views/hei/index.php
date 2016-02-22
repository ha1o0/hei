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
use common\models\Zan;
AppAsset::register($this);
$this->title = '嘿嘿';
// $this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/hello.css">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body style="background-color: #f8f8ff">
<?php $this->beginBody() ?>
<?php
if (!\yii::$app->user->isGuest) {
  echo "<script>var _user_id=1;</script>";
}else{
  echo "<script>var _user_id=0;</script>";
}
?>
<div style="background-color: coral; height:65px">
  <nav class="navbar navbar-Coral ">
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
        <?php if (isset(Yii::$app->user->identity->username)) { ?>
          <div class="col-lg-10 col-lg-offset-3" id="txname">
            <a href="?r=hei/profile&uid=<?php echo $urlid; ?>"><h5 style="color:white"><?php echo Yii::$app->user->identity->username;?></h5></a>
          </div>
        <?php }?>
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
<br>
<div class="col-lg-3">
    <div class="col-lg-12 col-lg-offset-4">
    <p>每日一笑</p>
    </div>
    <div class="col-lg-12 col-lg-offset-2">
    <h3 style="text-right">这里是一个笑话</h3>
    </div>
</div>
<div class="col-lg-5 col-lg-offset-0">
      <span><i class="countTxt">您还可以输入</i><strong id="maxnum" style="color:coral">250</strong><i>个字</i></span>
    <div>
      <?php $form = ActiveForm::begin(['id' => 'form-content','method'=>'post']); ?>

          <?= $form->field($model, 'content')->textarea(['cols'=> 40, 'rows'=>6, 'style'=> ['resize'=>'none'],'id' => 'content','onkeyup'=>'checkcontent()'])->label(false)?>
      <?php ActiveForm::end(); ?>
      <div class="form-group">
           <?= Html::submitButton('许下愿望！',['class' => 'btn', 'name' => 'hope-button', 'id' => 'login2', 'onmouseover'=>'checkcontent()']) ?><br>
          
      </div> 
      <div class="alert alert-info" id="contentsuccess" role="alert"></div>
    </div>
    <legend class=""></legend>
    <?php $n = State::find()->count();    //返回记录的数量
          $result = State::find()->where(['>','id',0])->asArray()->all(); 
          echo "<script>var n = \"$n\";</script>";
    ?>
    <legend class="">大家的愿望：</legend>
      <!--  数据库拉取所有状态并逐一显示（按数据库插入顺序显示，需要进行时间排序）-->
    <div>
      <?php for ($i=$n-1; $i>=0; $i--){ 
                $ii = $result[$i]['id'];
                $iii = (int)$ii;
                $commenti = Statement::find()->where(['scid'=>$iii])->count();
      ?>
      <div>
            <div class="col-lg-1 col-lg-offset-0">
              <?php $uid=$result[$i]['uid'];?>
              <a href="?r=hei/profile&uid=<?php echo $uid;?>" target="blank"><img src="./img/5050.png" class="img-circle"></a>
            </div>
            <div class="col-lg-4 col-lg-offset-0">
              <div class="col-lg-12 col-lg-offset-0">
                <a href="?r=hei/profile&uid=<?php echo $uid;?>" target="blank"><h5>
                <?php 
                  $result1 = User::find()->where(['id'=>$uid])->asArray()->one();
                  echo $result1['username'];
                  ?></h5></a>
              </div>
            </div>
            <div class="col-lg-4 col-lg-offset-7">
              <h6 style="color:gray">发布于：<?php print_r($result[$i]['time']); ?></h6>
            </div>
            <div class="col-lg-11 col-lg-offset-1">
              <div class="col-lg-12 col-lg-offset-0">
              <?php print_r($result[$i]['content']); ?>
              </div><h5>&nbsp;</h5>
            </div>
            <div class="col-lg-12 col-lg-offset-0">
              <?php if ($result[$i]['solved']!=0) { ?>
                <div class="col-lg-3 col-lg-offset-1">
                <button class="btn btn-default" disabled="disabled">已领取</button>
                </div>
              <?php }else{ 
                if(!\yii::$app->user->isGuest){
                  $zanif = Zan::find()->andWhere(['sid'=>$ii,'uid'=>yii::$app->user->identity->id])->asArray()->one();
                }else{            
                  $zanif1 = Zan::find()->andWhere(['sid'=>$ii,'zanip'=>yii::$app->request->userIP])->asArray()->one();
                }  
                ?>
                <div class="col-lg-3 col-lg-offset-1">
                  <button class="btn btn-default" onclick="lq(this.name)" name="<?php echo $ii;?>" id="<?php echo "g".$ii;?>">领取</button>
                </div>
              <?php 
              } 
              ?>
              <div class="col-lg-3 col-lg-offset-1 btncomment">
                <button class="btn btn-default" onclick="show(this.id)" id="<?php echo $ii;?>">评论 <?php echo $commenti; ?> </button>
              </div>
              <div class="col-lg-3 col-lg-offset-1">
                  <?php 
                      if ( (!\yii::$app->user->isGuest && $zanif != null) || (\yii::$app->user->isGuest && $zanif1 != null)) {
                  ?>
                  <button class="btn btn-default" disabled="disabled" id="<?php echo "z".$ii;?>" name="<?php echo $ii;?>">已赞 <?php echo Zan::find()->where(['sid'=>$result[$i]['id']])->count();?></button>
                  <?php }else{?>
                  <button class="btn btn-default" onclick="zan(this.name)" id="<?php echo "z".$ii;?>" name="<?php echo $ii;?>">点赞 <?php echo Zan::find()->where(['sid'=>$result[$i]['id']])->count();?></button>
                  <?php }?>
                </div><h5>&nbsp;</h5>
              <div class="col-lg-11 col-lg-offset-1 btncommenth" id= "<?php echo "_".$ii;?>" >
                    <?php $form=ActiveForm::begin(['id' => "x".$ii,'method'=>'post'])?>
                      <?= $form->field($modelc,'scid')->hiddeninput(['value'=>$iii])->label(false)?>
                      <?= $form->field($modelc,'scomment')->textarea(['cols'=>31, 'onpropertychange'=>'this.style.posHeight=this.scrollHeight', 'id'=>'t'.$ii])->label(false)?>  
                    <?php $form=ActiveForm::end()?>
                    <div class="form-group">
                        <?= Html::submitButton('评论', ['class' => 'btn login11', 'name' => $ii, 'id' => 'c'.$ii, 'onmouseover'=>'checkcomment()', 'onclick'=> 'comment(this.name)']) ?>
                    </div>
                    <div class="alert alert-info commentinfo" id="<?php echo "f".$ii;?>" role="alert"></div>
                    <!-- <div class="alert alert-info" id="commentsuccess" role="alert"></div> -->
                    <!--  每条状态下的评论区                 -->
                    <div>
                      <?php $commentr = Statement::find()->where(['scid'=>$iii])->asArray()->all();
                            for ($j=$commenti-1; $j>=0; $j--) { 
                      ?>
                            <legend class=""></legend>
                            <div class="col-lg-1 col-lg-offset-0">
                                  <?php $sid = $commentr[$j]['sid'];?>
                                  <a href="?r=hei/profile&uid=<?php echo $sid;?>" target="blank"><img src="./img/3030.png" alt="" class="img-circle"></a>
                            </div>
                            <div class="col-lg-4 col-lg-offset-0">
                                <a href="?r=hei/profile&uid=<?php echo $sid;?>" target="blank"><?php 
                                  $usernamec = User::find()->where(['id'=>$sid])->one();
                                  echo $usernamec['username'];
                                ?></a>
                            </div>
                            <div class="col-lg-3 col-lg-offset-4">
                                 <h6 style="color:gray"><?php print_r($commentr[$j]['sctime']); ?></h6>
                            </div>
                            <div class="col-lg-11 col-lg-offset-1">
                                <div class="col-lg-12 col-lg-offset-0">
                                <?php print_r($commentr[$j]['scomment']); ?>
                                </div>
                            </div>
                            <h6>&nbsp;</h6>
                            <?php 
                            }
                            ?>
                    </div>
              </div>
            </div>
      </div>
      <legend class=""></legend>
<?php } ?>
    </div>
</div>  
<!--
<div class="col-lg-4 col-lg-offset-0">
  <form class="form-horizontal">
  <fieldset>
    <div id="legend" class="">
      <legend class="">写下你的心情吧:</legend>
    </div>
    <div class="control-group">
        
        <div class="controls">
          <div class="textarea">
                <textarea id="riji" name="riji" cols="58" rows="7" style="resize: none"></textarea><br><br>
                <button class="btn btn-large btn-info">存档！</button>
          </div>
        </div>
        <br><legend class=""></legend>
      </div>
  </fieldset>
  </form>
</div>  <br> 
-->
<a href="javascript:;" id="btn" title="回到顶部"></a>
<script src="./assets/bootstrap.min.js"></script>
<script src="./assets/jquery.min.js"></script>
<script src="./assets/jquery.goup.min.js"></script>
<script src="./assets/index.js"></script>
<script type="text/javascript">
if (_user_id==0){
  $("#login2").attr('disabled',true);
  $("#contentsuccess").html("请登录后才能发布愿望哦");
  $("#contentsuccess").fadeIn();
}else{
  $("#contentsuccess").hide();
  $("#login2").click(function() {
    $("#login2").text("正在提交……");
    $("#login2").attr('disabled',true);
    $.ajax({
      url: "?r=hei/ajaxcontent",
      type: 'post',
      data: $("#form-content").serialize(),
      success: function (data) {
        $("#login2").attr('disabled',false);
        $("#login2").text("许下愿望！");
        $("#content").val("");
        $("#contentsuccess").html("发布成功！").fadeIn().delay("3000").fadeOut();
      }
    })
  });
}
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

