<?php
mb_language("japanese");
mb_internal_encoding("UTF-8");
session_start();
$_SESSION['mode']='delUrl';
redirectTo(makeUrl('model_controller.php'));

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

