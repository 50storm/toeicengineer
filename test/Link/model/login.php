<?php
//セッション使う
session_start();

mb_language("japanese");
mb_internal_encoding("UTF-8");
require_once('../Class/Utility.php');
//TODO JavaScriptでやる
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

//sesssion追加後でやる
//setcookie("email", $_POST['email'], time()+(60*60*24*30) ,$_SERVER['HTTP_HOST'] ); //30日
//setcookie("password",$_POST['password'], time()+(60*60*24*30),$_SERVER['HTTP_HOST']  );
//echo $_COOKIE["email"];
//echo $_COOKIE["password"];


//emailをセッションで渡す
$_SESSION['email']=$_POST['email'];
$_SESSION['password']=$_POST['password'];
$_SESSION['mode']='login';

///add

$UserId_email    = $_SESSION['email'];
$UserId_password = $_SESSION['password'];

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
	$sql = "SELECT * FROM toeicengineer_db.userid WHERE email=:email and password=:password";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":email", $UserId_email);
	$stmt->bindParam(":password", $UserId_password);
	$stmt->execute();
	$row=$stmt->fetch();
	
	if (intVal($stmt->rowCount())==0){
		//ログインページに戻る
		$_SESSION['msg']='ログインできませんでした';
		$uri=Utility::makeUrlController('view_controller.php?page=login');
		header("Location: $uri");
		exit;
	}else{
		//リダイレクト
		/* カレントディレクトリの別のページにリダイレクトします */
		//$host  = $_SERVER['HTTP_HOST'];
		//$uri   = rtrim(dirname(dirname($_SERVER['PHP_SELF']))).'/view';
		//$extra = 'myPage.php';
		$_SESSION['userId'] =$row['userId'];
		$_SESSION['msg']=   "";
		$uri=Utility::makeUrlController('view_controller.php?page=myPage');
		header("Location: $uri");
		exit;
	}
}catch(PDOException $e){
	echo $e->getMessage();
	exit;
}
?>