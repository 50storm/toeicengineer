<?php
session_start();
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
$stmt = $pdo->prepare(
					"INSERT INTO UserId(email, userId, password)VALUES(:email, :userId, :password);"
					);

$UserId_email = $_SESSION['email'];
$UserId_userId = $_SESSION['userId'];
$UserId_password = $_SESSION['password'];

$stmt->bindParam(":email", $UserId_email);
$stmt->bindParam(":userId", $UserId_userId);
$stmt->bindParam(":password", $UserId_password);
$stmt->execute();


$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname(dirname($_SERVER['PHP_SELF']))).'/'.'view';
$extra = 'myPage.php';
//header("Location: http://$host$uri/$extra");
//exit;


$next_page = "http://".$host.$uri."/".$extra;
echo $next_page;
echo $_SESSION['email'];
echo <<< EOM
アカウント登録しました。<br />
<a href="{$next_page}" >MyPage登録へ<a/>
EOM;


?>