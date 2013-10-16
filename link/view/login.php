<?php
session_start();
var_dump($_SESSION);
require_once('../Class/Utility.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel='stylesheet' type='text/css' href='../css/com.css' />  
<style>
.water { color: #ccc; } 
.focus { color: black; } 
</style>
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">
	google.load("jquery", "1.6.1");
</script>
<script>
$(function () {
	//必須チェック
	$('#login').click(function(){
		var email　=　$('#TextEmail').val();
		if(email==''){
			alert("mail");
			$('#TextEmail').css('background-color', 'Lime');
			return false;
		}else{
		
			$('#TextEmail').css('background-color', 'wite');
		}
		
		var pass= $('#TextPass').val();
		if(pass==''){
			alert("pass");
			$('#TextEmail').css('background-color', 'Lime');
			return false;
		}else{
			$('#TextEmail').css('background-color', 'wite');
		}
	})

	$('#TextEmail').blur(function(){
			$(this).addClass('water');
	})

	$('#TextEmail').focus(function(){
		$(this).removeClass('water');
	})
 
	$('#TextPass').blur(function(){
		$(this).addClass('water');
		
	})
	
	$('#TextPass').focus(function(){
		$(this).removeClass('water');
		
	  })

});
</script>
<title>認証画面</title>
</head>
<body>
<div id="wrap">
	<div id="head">
		<h1>認証画面</h1>
	</div>
	<div id="content">
		<form id="frmInput" name="frmInput" method="post" action="../model/login.php">
			<div>
				<label for="TextEmail" >メールアドレス</label>
				<input id="TextEmail"  class="input" name="email" type="text" id="email" value=""/>
			</div>
			<div>
				<label for="TextPass" >パスワード</label>
				<input id="TextPass"  name="password" type="password" id="password" size="35"  value="" />
			</div>
			<div>
				<input id="login"  type="submit" value="ログイン" />
			</div>
		</form>
	</div>
</div>
</body>
</html>
