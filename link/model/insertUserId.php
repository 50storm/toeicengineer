<?php
//セッション使う
session_start();
mb_language("japanese");
mb_internal_encoding("UTF-8");
require_once('../Class/Utility.php');
//入力チェック
$flgErr=false;
$errMsg="";
if (empty($_POST['email'])) {
	$flgErr=true;
	$errMsg='メールアドレスが入力されていません。';
	
}else{
	if(!Utility::is_mail($_POST['email'])){
		$flgErr=true;
		$errMsg='メールアドレスの形式が正しくありません。';
	}
}
if (empty($_POST['userId'])) {
	$flgErr=true;
	$errMsg='ユーザーIDが入力されていません。';
	
}
if (empty($_POST['password'])) {
	$flgErr=true;
	$errMsg='パスワードが入力されていません。';

}
//エラーがあればView画面に戻す
if ($flgErr==true){
	$_SESSION['msg']=$errMsg;
	$Uri=Utility::makeUrlController('view_controller.php?page=login');
	header("Location: $Uri");
	exit;
}else{
	$_SESSION['msg']="";
}


if ($_SERVER['HTTP_HOST'] == 'localhost'){
	$dsn      = 'mysql:dbname=toeicengineer_db;host=localhost';
	$user     = 'toeicengineer';
	$password = 'abc';
	var_dump($dsn);
	var_dump($user);
	var_dump($password);
	
}else{
	$dsn      ='mysql:dbname=toeicengineer_db;host=mysql464.db.sakura.ne.jp';
	$user     ='toeicengineer';
	$password ='hiro1128';
}

try{
	$pdo = new PDO($dsn, $user, $password);
	$stmt = $pdo->prepare(
						"INSERT INTO UserId(email, userId, password)VALUES(:email, :userId, :password);"
						);


	//$UserId_email = $_SESSION['email'];
	//$UserId_userId = $_SESSION['userId'];
	//$UserId_password = $_SESSION['password'];
	
	$UserId_email = $_POST['email'];
	$UserId_userId = $_POST['userId'];
	$UserId_password = $_POST['password'];
	
	$stmt->bindParam(":email", $UserId_email);
	$stmt->bindParam(":userId", $UserId_userId);
	$stmt->bindParam(":password", $UserId_password);
	$stmt->execute();

}catch(PDOException $e){
	echo $e->getMessage();
	exit;

}

//セッションに登録
//session_start();
$_SESSION['email']=$_POST['email'];
$_SESSION['userId']=$_POST['userId'];
$_SESSION['password']=$_POST['password'];

//リダイレクト
//$host  = $_SERVER['HTTP_HOST'];
//$uri   = rtrim(dirname(dirname($_SERVER['PHP_SELF']))).'/'.'view';
//$extra = 'myPage.php';
//$next_page = "http://".$host.$uri."/".$extra;
//echo $next_page;
//echo $_SESSION['email'];
//echo <<< EOM
//アカウント登録しました。<br />
//<a href="{$next_page}" >MyPage登録へ<a/>
//EOM;


//リダイレクト
//ログイン画面
$Uri=Utility::makeUrlController('view_controller.php?page=login');
header("Location: $Uri");
exit;
?>