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
use common\models\Zan;
AppAsset::register($this);
$this->title = '个人主页';
// $this->params['breadcrumbs'][] = $this->title;
?>
<?php 
if (isset($_GET['uid'])) {
	$userinfo = Userinfo::find()->where(['uid'=>$_GET['uid']])->asArray()->one();
	$result = State::find()->where(['uid'=>$_GET['uid']])->asArray()->all();
	$n = State::find()->where(['uid'=>$_GET['uid']])->count();
	$pro = Provinces::find()->where(['provinceid'=>$userinfo['provinceid']])->asArray()->one();
	$cit = Cities::find()->where(['cityid'=>$userinfo['cityid']])->asArray()->one();
	$are = Areas::find()->where(['areaid'=>$userinfo['areaid']])->asArray()->one();
	echo "<script>var n= \"$n\";var arr=new Array();</script>";
}else{
	$userinfo = Userinfo::find()->where(['uid'=>yii::$app->user->identity->id])->asArray()->one();
	$result = State::find()->where(['uid'=>yii::$app->user->identity->id])->asArray()->all();
	$n = State::find()->where(['uid'=>yii::$app->user->identity->id])->count();
	$pro = Provinces::find()->where(['provinceid'=>$userinfo['provinceid']])->asArray()->one();
	$cit = Cities::find()->where(['cityid'=>$userinfo['cityid']])->asArray()->one();
	$are = Areas::find()->where(['areaid'=>$userinfo['areaid']])->asArray()->one();
	echo "<script>var n = \"$n\";var arr=new Array();</script>";
}
?>
<div class="container">
	  <div class="col-lg-4 col-lg-offset-0">
	  	<br><br><br>
	  	<div class="col-lg-6 col-lg-offset-2">
		  	<legend class=""></legend>
		  	<legend><h2>个人资料<?php if($_GET['uid']==yii::$app->user->identity->id) {?><a href="?r=hei/editprofile"><img src="./img/edit1.png" alt="编辑个人信息"></a><?php }?></h2></legend>
	  	</div>
	  </div>
	  <div class="col-lg-4 col-lg-offset-0">
	  	<div class="col-lg-6 col-lg-offset-2">
		<a href=""><img src="./img/180180.png" alt="" class="img-circle"></a>
		</div>
	  </div>
	  <div class="col-lg-4 col-lg-offset-0">
	  	<br><br><br>
	  	<div class="col-lg-6 col-lg-offset-2">
	  	<legend class=""></legend>
	  	<legend class=""><h2>&nbsp;全部心愿</h2></legend>
	  	</div>
	  </div>
	<div class="col-lg-5" style="background-color: white;">
	<legend class="">个人信息</legend>
		<h4>真实姓名:<?php echo $userinfo['truename']; ?></h4>
		<h4>生日:<?php echo $userinfo['birthday']; ?></h4>
		<h4>性别:<?php if($userinfo['gender']==1){
							echo "男";
						}else{
							echo "女";} ?></h4>
		<h4>地址:<?php echo $pro['province'].$cit['city'].$are['area'].$userinfo['address']?></h4>
		<h4>毕业学校:<?php echo $userinfo['university']; ?></h4>
		<h4>兴趣爱好:<?php echo $userinfo['hobby']; ?></h4>					
		<legend class=""></legend>
		<legend class="">联系方式</legend>
		<h4>qq:<?php echo $userinfo['qq']; ?></h4>
		<h4>微信:<?php echo $userinfo['weixin']; ?></h4>
		<h4>电话:<?php echo $userinfo['phone']; ?></h4>
		<h4>电子邮箱:<?php echo yii::$app->user->identity->email; ?></h4>
	</div>
	<div class="col-lg-6 col-lg-offset-1">
	  <div class="col-lg-12 col-lg-offset-2">
		<?php  for($i=$n-1;$i>=0;$i--){ 
			$ii = $result[$i]['id'];
	              echo "<script>
	              		var cn=\"$n\"-\"$i\";
	              		arr[cn]=\"$ii\";
	              		</script>";
	              $iii = (int)$ii;
	              $commenti = Statement::find()->where(['scid'=>$iii])->count();
	              $zanif = Zan::find()->andWhere(['sid'=>$ii,'uid'=>yii::$app->user->identity->id])->asArray()->one();
	              $zanif1 = Zan::find()->andWhere(['sid'=>$ii,'zanip'=>yii::$app->request->userIP])->asArray()->one();
			?>
			<div id="<?php echo "a".$ii;?>">
				<div class="col-lg-1 col-lg-offset-0">
					<?php $uid=$result[$i]['uid'];?>
              		<a href="?r=hei/profile&uid=<?php echo $uid;?>" target="blank"><img src="./img/5050.png" class="img-circle"></a>
            	</div>
            	<div class="col-lg-1 col-lg-offset-0">
              		<div class="col-lg-12 col-lg-offset-2">
	                <a href="?r=hei/profile&uid=<?php echo $uid;?>" target="blank"><h4><?php   
	                  $result1 = User::find()->where(['id'=>$uid])->asArray()->one();
	                  echo $result1['username'];
	                  ?></h4></a>
              		</div>
            	</div>
            	<div class="col-lg-3 col-lg-offset-7">
              		<h6 style="color:gray"><?php print_r($result[$i]['time']); ?></h6>
            	</div>
           	 	<div class="col-lg-11 col-lg-offset-1">
              		<div class="col-lg-12 col-lg-offset-0">
              			<?php print_r($result[$i]['content']); ?>
              		</div>
            	</div>	
            	<!--判断是否登陆者主页，更换状态显示情况和权限-->             
            	<?php if( (!isset($_GET['uid']) || ($_GET['uid']==yii::$app->user->identity->id))) {?>
	              <?php if ($result[$i]['solved']!=0) { ?>
	                <div class="col-lg-2 col-lg-offset-1">
	                <button class="btn btn-default" disabled="disabled">已领取</button>
	                </div>
	              <?php }else{ ?>
	                <div class="col-lg-2 col-lg-offset-1">
	                  <button class="btn btn-default">领取</button>
	                </div>
	              <?php 
	              }  ?>
	              <div class="col-lg-2 col-lg-offset-1 btncomment">
	                <button class="btn btn-default" onclick="show(this.id)" id="<?php echo $ii;?>">评论 <?php echo $commenti; ?> </button>
	              </div>
	              <div class="col-lg-2 col-lg-offset-1">
	              <?php 
	              		  if ($zanif != null || $zanif1 != null) {
	              ?>
	              	<button class="btn btn-default" disabled="disabled" id="<?php echo 'z'.$ii;?>" name="<?php echo $ii;?>">已赞 <?php echo Zan::find()->where(['sid'=>$result[$i]['id']])->count();?></button>
	              	<?php }else{?>
	                <button class="btn btn-default" onclick="zan(this.name)" id="<?php echo 'z'.$ii;?>" name="<?php echo $ii;?>">点赞 <?php echo Zan::find()->where(['sid'=>$result[$i]['id']])->count();?></button>
	                <?php }?>
	              </div>
	              <div class="col-lg-2 col-lg-offset-1">
	              	<button class="btn btn-default" onclick="firm(this.id)" id="<?php echo $ii;?>">删除</button>
	              </div>
	              <?php } else{ ?>
					<?php if ($result[$i]['solved']!=0) { ?>
	                <div class="col-lg-3 col-lg-offset-1">
	                <button class="btn btn-default" disabled="disabled">已领取</button>
	                </div>
	              <?php }else{ ?>
	                <div class="col-lg-3 col-lg-offset-1">
	                  <button class="btn btn-default">领取</button>
	                </div>
	              <?php 
	              }  ?>
	              <div class="col-lg-3 col-lg-offset-1 btncomment">
	                <button class="btn btn-default" onclick="show(this.id)" id="<?php echo $ii;?>">评论 <?php echo $commenti; ?> </button>
	              </div>
	              <div class="col-lg-3 col-lg-offset-1">
	              	<?php 
	              		  if ($zanif != null || $zanif1 != null) {
	              	?>
	              	<button class="btn btn-default" disabled="disabled" id="<?php echo 'z'.$ii;?>" name="<?php echo $ii;?>">已赞 <?php echo Zan::find()->where(['sid'=>$result[$i]['id']])->count();?></button>
	              	<?php }else{?>
	                <button class="btn btn-default" onclick="zan(this.name)" id="<?php echo 'z'.$ii;?>" name="<?php echo $ii;?>">点赞 <?php echo Zan::find()->where(['sid'=>$result[$i]['id']])->count();?></button>
	                <?php }?>
	              </div>
	              <?php }?>
	              <div class="col-lg-11 col-lg-offset-1 btncommenth" id= "<?php echo "_".$ii;?>" >
	                    <?php $form=ActiveForm::begin(['id' => 'form-comment','method'=>'post','action'=>'?r=hei/commentp'])?>
	                      <?= $form->field($modelc,'scid')->hiddeninput(['value'=>$iii])->label(false)?>
	                      <?= $form->field($modelc,'scomment')->textarea(['cols'=>31, 'onpropertychange'=>'this.style.posHeight=this.scrollHeight'])->label(false)?>
	                      <div class="form-group">
	                        <?= Html::submitButton('评论', ['class' => 'btn', 'name' => 'comment-button', 'id' => 'login11']) ?>
	                      </div>
	                    <?php $form=ActiveForm::end()?>
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
	                            <div class="col-lg-1 col-lg-offset-0">
	                                <a href="?r=hei/profile&uid=<?php echo $sid;?>" target="blank"><?php 
	                                  $usernamec = User::find()->where(['id'=>$sid])->one();
	                                  echo $usernamec['username'];
	                                ?></a>
	                            </div>
	                            <div class="col-lg-3 col-lg-offset-7">
	                                 <h6 style="color:gray"><?php print_r($commentr[$j]['sctime']); ?></h6>
	                            </div>
	                            <div class="col-lg-11 col-lg-offset-1">
	                                <?php print_r($commentr[$j]['scomment']); ?>
	                            </div>
	                            <?php 
	                            }
	                            ?>
	                    </div>
	              </div>
	              <legend class=""></legend>
			</div>
			
		<?php }?>
	  </div>
	</div>
</div>

<script src="./assets/bootstrap.min.js"></script>
<script src="./assets/jquery.min.js"></script>
<script src="./assets/jquery.goup.min.js"></script>
<script src="./assets/index.js"></script>
<script type="text/javascript">
$(".btncommenth").hide();
function show(i){
  if ($("#"+'_'+i).is(":hidden")){
    $("#"+'_'+i).fadeIn();
  }else{
    $("#"+'_'+i).hide();
  };     
}
//删除模态框：
function firm(j) {   
	if (confirm("你确定删除吗？")) {  
		$.ajax({
			url: '?r=hei/delete',
			type: 'post',
			data: {sid:j},
			success: function(data){
				$("#"+'a'+j).fadeOut();
			}
		})	
	}  
	else {  
	}  
} 
function zan(j){
	$.ajax({
		url: '?r=hei/zan',
		type: 'post',
		data: {sid:j},
		success: function(data){
			$("#"+'z'+j).attr('disabled',true);
			$("#"+'z'+j).text('已赞');
		}
	})
	
} 
</script>