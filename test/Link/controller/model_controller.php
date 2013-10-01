<?php
//var_dump($_POST);
//exit;
/*************
*Modelコントローラー*
**************/
//データベースへの問い合わせ
session_start();
switch($_SESSION['mode']){
case 'insUserId'://insert userId
	redirectTo(makeUrl('insertUserId.php'));

case 'insUrl':
	redirectTo(makeUrl('insertUrl.php'));

case 'updUrl':
	redirectTo(makeUrl('updUrl.php'));

case 'delUrl':
	redirectTo(makeUrl('deleteUrl.php'));

case 'login':
	redirectTo(makeUrl('login.php'));
	//redirectTo(makeViewUrl('myPage.php'));

}



function makeUrl($file){
	$Url='';

	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname(dirname($_SERVER['PHP_SELF']))).'/'.'model';
	$Url = "http://".$host.$uri."/".$file;
	var_dump($Url);
	return $Url;
}

function makeViewUrl($file){
	$Url='';

	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname(dirname($_SERVER['PHP_SELF']))).'/'.'view';
	$Url = "http://".$host.$uri."/".$file;
	var_dump($Url);
	return $Url;
}



function redirectTo($Uri){
	header("Location: $Uri");
	exit;
}

?>