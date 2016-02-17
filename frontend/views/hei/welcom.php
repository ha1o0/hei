<?php $this->title = '欢迎来到嘿嘿'; ?>
<div class="container-fluid">
	<div class="row">
		<h1 class="col-md-12 text-center" id="center">哈哈哈哈哈哈哈哈哈哈</h2><br>
		<h1 class="col-md-12 text-center" id="center">哈哈哈哈哈哈哈哈</h2><br>
		<h1 class="col-md-12 text-center" id="center">欢迎来到这里！</h1><br><br>
	</div>
	<hr style="height:1px;border:none;border-top:1px solid #696969">
	<br><br><br><br><br><br><br><br><br><br>
	<div class="row ">
		<button  class="col-md-2 col-md-offset-4 btn" id="login1" onclick="tz()">登    录</button>
		<button  class="col-md-2 col-md-offset-2 btn" id="register1" onclick="tz1()">注    册</button>	
	</div>

	<div>
		<div>
			<img alt="" src="" class="img-rounded">	
		</div>	
	</div>
</div>
<script src="./assets/bootstrap.min.js"></script>
<script src="./assets/jquery.min.js"></script>       
<script>
     function tz(){
		window.location.href='?r=hei/login';
	}
	function tz1(){
		window.location.href='?r=hei/signup';
	}
</script>

