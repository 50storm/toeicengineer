<?php
//var_dump($_GET);
//exit;


mb_language("japanese");
mb_internal_encoding("UTF-8");
require_once('../Class/Utility.php');
$objUtility = new Utility();


/****
JavaScriptでやる
***/
$flgErr=false;
$errMsg="";
if (empty($_POST['email'])) {
	$flgErr=true;
	$errMsg='メールアドレスが入力されていません。';
	//print('メールアドレスが入力されていません。');
	//exit;
	
}else{
	if(!$objUtility->is_mail($_POST['email'])){
		$flgErr=true;
		$errMsg='メールアドレスの形式が正しくありません。';
		//print('メールアドレスの形式が正しくありません。');
		//exit;
	}
}
if (empty($_POST['password'])) {
	$flgErr=true;
	$errMsg='パスワードが入力されていません。';
	//print('パスワードが入力されていません。');
	//exit;
}
if ($flgErr==true){
	$_SESSION['msg']=$errMsg;
	$Uri=$objUtility->makeUrlController('view_controller.php?page=login');
	//var_dump($_SESSION['msg']);
	header("Location: $Uri");
	exit;
}else{
	$_SESSION[msg]="";
}


setcookie("email", $_POST['email'], time()+(60*60*24*30) ,$_SERVER['HTTP_HOST'] ); //30日
setcookie("password",$_POST['password'], time()+(60*60*24*30),$_SERVER['HTTP_HOST']  );
//echo $_COOKIE["email"];
//echo $_COOKIE["password"];

//exit;


//emailをセッションで渡す
session_start();
$_SESSION['email']=$_POST['email'];
$_SESSION['password']=$_POST['password'];
$_SESSION['mode']='login';
//redirectTo(makeUrl('model_controller.php'));
$Uri=$objUtility->makeUrlController('model_controller.php');
header("Location: $Uri");
exit;
