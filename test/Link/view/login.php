<?php

session_start();
require_once('../Class/Utility.php');
$objUtility = new Utility();

if (isset($_COOKIE['email'])){
	//$email = $_COOKIE["email"];
	echo $_COOKIE['email'];
	$email=$_COOKIE['email'];
}else{
	$email="";
}
//var_dump($email);

if (isset($_COOKIE['password'])){
	//$password = $_COOKIE['password'];
	//echo "$password" ;
	$password= $_COOKIE['password'];
}else{
	$password= "";
}
if (isSet($_SESSION['msg'])){
	$msgFlg=true;
}else{
	$msgFlg=false;
}
if ($msgFlg==true){
	$msg=$_SESSION['msg'];
}else{
	$msg="";
}
//var_dump($msgFlg);
//var_dump($_SESSION);
//echo($objUtility->h("<a>ancher</a>"));

//var_dump($password);

?>
<?php
/*
require_once('../Class/Utility.php');
$objUtility = new Utility();
session_start();
//var_dump($_SESSION);
//var_dump($_POST);
$msg="";
if (empty($_POST['email'])){
	
	$msg="Emailを入力";
	//$_POST=array();
}

if (empty($_POST['password'])){
	//var_dump($_POST);
	$msg="Passwordを入力";
	//$_POST=array();
}
*/
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style>
#divEmail{
/*
	border: 1px solid #FF0000;
*/
	width:510px;
	height:20px;
	float: left;
}
#divPass{
/*
	border: 1px solid #FF0000;
*/
	width:510px;
	height:20px;
	clear: left;
}
#LabelEmail{
					display: block;
					width:100px;
					height:20px;
					float: left;
					background-color:AliceBlue;
}

#TextEmail{
					display: block;
					width:400px;
					height:20px;
					float: left;
					background-color:Azure;
}

#LabelPass{
					display: block;
					width:100px;
					height:20px;
					float:left;
					background-color:AliceBlue;
}
#TextPass{
					display: block;
					width:200px;
					height:20px;
					float:left;
					background-color:Azure;
}
#login{
					
}
.water { color: #ccc; } 
.focus { color: black; } 
</style>
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">
	google.load("jquery", "1.6.1");
</script>
<script>
    $(function () {  
//      $('#TextEmail')
//		.addClass('water')
//		.val('メールアドレス');
      $('#TextEmail').blur(function(){
			$(this).addClass('water');
			//$(this).removeClass('water');
			//$(this).val('メールアドレス');
	  })
      $('#TextEmail').focus(function(){
		$(this).removeClass('water');
	  })
 
//      $('#TextPass')
//		.addClass('water')
//		.val('メールアドレス');
      $('#TextPass').blur(function(){
		$(this).addClass('water');
		
	  })
      $('#TextPass').focus(function(){
		$(this).removeClass('water');
		
	  })
  
    });
</script>
<title>ログイン</title>
</head>
<body>
<div id="wrap">
	<div id="head">
	</div>
	<div id="content">
	
		<form id="frmInput" name="frmInput" method="post" action="../validater/validateLogin.php?page=login">
	
	<!--
		<form id="frmInput" name="frmInput" method="post" action="Login.php">
	-->
			<div id="divEmail">
				<!--<label id="LabelEmail" for="email" class="input" >メールアドレス</label>-->
				<input id="TextEmail"  class="input" name="email" type="text" id="email" value=""/>
			</div>
			<div id="divPass">
				<!--<label id="LabelPass" for="password" class="input">パスワード</label>-->
				<input id="TextPass"  name="password" type="password" id="password" size="35"  value="" />
				<input id="login"  type="submit" value="ログイン" />
			</div>
			<div id="msg">
				<p><?php echo $objUtility->h($msg); ?></p>
			</div>
		</form>
	</div>
</div>
</body>
</html>
