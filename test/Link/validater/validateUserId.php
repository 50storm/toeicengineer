<?php
echo "----start-----";
mb_language("japanese");
mb_internal_encoding("UTF-8");
echo "----start-----";
if (empty($_POST['email'])) {
	print('メールアドレスが入力されていません。');
	exit();
}else{
	if(!is_mail($_POST['email'])){
		print('メールアドレスの形式が正しくありません。');
		exit();
	}
}
if (empty($_POST['userId'])) {
	print('ユーザーIDが入力されていません。');
	exit();
}
if (empty($_POST['password'])) {
	print('パスワードが入力されていません。');
	exit();
}
echo "----end-----";


//emailをセッションで渡す
session_start();
$_SESSION['email']=$_POST['email'];
$_SESSION['userId']=$_POST['userId'];
$_SESSION['password']=$_POST['password'];

//ToModelController
redirectTo(makeUrl('model_controller.php'));


/*
関数
*/
function is_mail($text) {
	if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $text)) {
		return TRUE;
	} else {
		return FALSE;
	}
}
function makeUrl($file){
	$Url='';

	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname(dirname($_SERVER['PHP_SELF']))).'/'.'controller';
	$Url = "http://".$host.$uri."/".$file;
	var_dump($Url);
	return $Url;
}

function redirectTo($Uri){
	header("Location: $Uri");
	exit;
}


