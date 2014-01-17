<?php
mb_language("japanese");
mb_internal_encoding("UTF-8");

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



var_dump($_SESSION['url']);
var_dump($_SESSION['email']);
var_dump($_SESSION['name']);
var_dump($_SESSION['tag']);
var_dump($_SESSION['seq']);


$_SESSION['mode']='updUrl';
redirectTo(makeUrl('model_controller.php'));

/*
関数
*/
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


