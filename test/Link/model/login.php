<?php
mb_language("japanese");
mb_internal_encoding("UTF-8");
require_once('../Class/Utility.php');
$objUtility = new Utility();

session_start();
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

?>