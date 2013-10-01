<?php
mb_language("japanese");
mb_internal_encoding("UTF-8");
if (empty($_POST['url'])) {
	print('URLが入力されていません。');
	exit();
}

if (empty($_POST['name'])) {
	print('表示名が入力されていません。');
	exit();
}
//emailをセッションで渡す
session_start();
$_SESSION['url']=$_POST['url'];
$_SESSION['name']=$_POST['name'];
if (empty($_POST['tag'])) {
	$_SESSION['tag']="タグなし";
}else{
	$_SESSION['tag']=$_POST['tag'];
}


//ToModelController
session_start();
$_SESSION['mode']='insUrl';
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


