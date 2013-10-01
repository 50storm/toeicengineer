<?php
session_start();

if (isSet($_GET['page'])){
	switch($_GET['page']){
	//表示名をUpdate
	case 'updUserId':
		header("Location: ".makeUrl('updUserId.php'));
		exit;
	//ブックマーク登録
	case 'insUrl':
		header("Location: ".makeUrl('insertUrl.php'));
		exit;
	//ブックマークの表示名を登録
	case 'updUrl':
		$_SESSION['seq']=$_GET['seq'];
		header("Location: ".makeUrl('updUrl.php'));
		exit;
	case 'delUrl':
		$_SESSION['seq']=$_GET['seq'];
		header("Location: ".makeUrl('deleteUrl.php'));
		exit;
	case 'myPage':
		header("Location: ".makeUrl('myPage.php'));
		exit;
	case 'login':
		header("Location: ".makeUrl('login.php'));
		exit;
	}
}

function makeUrl($file){
	$Url='';

	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname(dirname($_SERVER['PHP_SELF']))).'/'.'view';
	$Url = "http://".$host.$uri."/".$file;
	return $Url;
}

?>