<?php
/**************************
  GETリクストでもらったパラメータで
  Viewの画面へ飛ばす
***************************/
require_once('../../Class/Utility.php');
session_start();
//echo "start";
//var_dump($_GET);

if (isSet($_GET['page'])){
	switch($_GET['page']){
	/***
	 コーディング規約
	 case 'viewName':
	 とする
	***/
	//表示名をUpdate
	
	case 'updUserId':
		header("Location: ".makeUrl('updUserId.php'));
		exit;
	//ブックマーク登録
	case 'insertUrl':
		header("Location: ".makeUrl('insertUrl.php'));
		exit;
	//ブックマークの表示名を登録
	case 'updateUrl':
		$_SESSION['seq']=$_GET['seq'];
		header("Location: ".makeUrl('updateUrl.php'));
		exit;
	case 'delUrl':
		$_SESSION['seq']=$_GET['seq'];
		header("Location: ".makeUrl('deleteUrl.php'));
		exit;
	//マイページ(Test用)
	case 'myPage':
		header("Location: ".makeUrl('myPage.php'));
		exit;
	case 'link':
		//$url=makeUrl('link.php');
		$url=Utility::makeLinkUrl('link.php');
		//var_dump($url);
		header("Location: ".$url);
		exit;
	//ログイン画面
	case 'login':
		if($_GET['action']=='insertUrl'){
			$_SESSION['action']='insertUrl';
		}else{
		
		}
		var_dump($_SESSION);
		header("Location: ".makeUrl('login.php'));
		exit;
	//ユーザーID登録画面
	case 'insertUserId':
		header("Location: ".makeUrl('insertUserId.php'));
		exit;
	}
}

function makeUrl($file){
	$Url='';

	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname(dirname($_SERVER['PHP_SELF']))).'/'.'view';
	$Url = "http://".$host.$uri."/".$file;
	return $Url;
	//var_dump($Url);
	//exit;
}

?>