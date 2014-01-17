<?php
session_start();
mb_language("japanese");
mb_internal_encoding("UTF-8");

var_dump($_POST);
require_once('../Class/Utility.php');
//チェック
$flgErr=false;
$errMsg="";
//チェック
if (empty($_POST['url'])) {
	$flgErr=true;
	$errMsg='URLが入力されていません。';
}


if (empty($_POST['name'])) {
	$flgErr=true;
	$errMsg='表示名が入力されていません。';
}

//エラーがあればView画面に戻す
if ($flgErr==true){
	$_SESSION['msg']=$errMsg;
	$Uri=Utility::makeUrlController('view_controller.php?page=updateUrl');
	header("Location: $Uri");
	exit;
}else{
	$_SESSION['msg']="";
}


if (empty($_POST['tag'])) {
	$_SESSION['tag']="タグなし";
}else{
	$_SESSION['tag']=$_POST['tag'];
}



if ($_SERVER['HTTP_HOST'] == 'localhost'){
	$dsn      = 'mysql:dbname=toeicengineer_db;host=localhost';
	$user     = 'toeicengineer';
	$password = 'abc';
}else{
	$dsn      ='mysql:dbname=toeicengineer_db;host=mysql464.db.sakura.ne.jp';
	$user     ='toeicengineer';
	$password ='hiro1128';
}

try{
	$pdo = new PDO($dsn, $user, $password);
	
	$stmt = $pdo->prepare(
			"UPDATE toeicengineer_db.link 
			set 
				url=:url,
				name=:name,
				tag=:tag 
			where seq =:seq"
	);
	
	//$seq       = $_SESSION['seq'];
	//$url       = $_SESSION['url'];
	//$name      = $_SESSION['name'];
	//$tag       = $_SESSION['tag'];
	
	$seq       = $_SESSION['seq'];
	$url       = $_POST['url'];
	$name      = $_POST['name'];
	$tag       = $_POST['tag'];
	
	$stmt->bindParam(":seq"  , $seq);
	$stmt->bindParam(":url"  , $url);
	$stmt->bindParam(":name" , $name);
	$stmt->bindParam(":tag"  , $tag);
	$stmt->execute();
}catch(PDOException $e){
	echo $e->getMessage();
	exit;

}


//マイページへリダイレクト
//redirectTo(makeUrl('view_controller.php?page=myPage'));

$Uri=Utility::makeUrlController('view_controller.php?page=myPage');
header("Location: $Uri");
exit;

/*
関数
*/
function makeUrl($file){
	$Url='';

	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname(dirname($_SERVER['PHP_SELF']))).'/'.'controller';
	$Url = "http://".$host.$uri."/".$file;
	return $Url;
}

function redirectTo($Uri){
	header("Location: $Uri");
	exit;
}
?>

