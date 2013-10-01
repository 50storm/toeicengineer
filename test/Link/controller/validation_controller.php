<?php

$page_insertUser=makeUrl('validateUserId.php');
var_dump($page_insertUser);

session_start();
switch($_SESSION['mode']){
case 'insUserId'://insert userId
	//チェック
	
	//チェックOKだったらDBへ
	redirectTo($page_insertUser);
	
case '':
case '':
}



function makeUrl($file){
	$Url='';

	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname(dirname($_SERVER['PHP_SELF']))).'/'.'validater';
	$Url = "http://".$host.$uri."/".$file;
	var_dump($Url);
	return $Url;
}

function redirectTo($Uri){
	header("Location: $Uri");
	exit;
}

?>