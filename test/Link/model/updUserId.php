<?php
session_start();
mb_language("japanese");
mb_internal_encoding("UTF-8");

var_dump($_SERVER['REQUEST_URI']);
var_dump($_SERVER['HTTP_HOST']);
var_dump($_SERVER['PHP_SELF']);
var_dump(rtrim(dirname($_SERVER['PHP_SELF'])));
var_dump(rtrim(dirname(dirname($_SERVER['PHP_SELF']))));


if (empty($_POST['email'])) {
	print('メールアドレスが入力されていません。');
	exit();
}else{
	if(!is_mail($_POST['email'])){
		print('メールアドレスの形式が正しくありません。');
		exit();
	}
}
if (empty($_POST['userId'])) {
	print('ユーザーIDが入力されていません。');
	exit();
}
if (empty($_POST['password'])) {
	print('パスワードが入力されていません。');
	exit();
}

//setcookie('name','value','time()+60*60');
setcookie('name','value',time()+60*(60));

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
		"UPDATE toeicengineer_db.userId(email, userId, password)VALUES(:email, :userId, :password);"
);
$UserId_email    = $_SESSION['email'];
$UserId_userId   = $_SESSION['userId'];
$UserId_password = $_SESSION['password'];
$stmt->bindParam(":email", $UserId_email);
$stmt->bindParam(":userId", $UserId_userId);
$stmt->bindParam(":password", $UserId_password);
$stmt->execute();


//$_SESSION['email']=$_POST['email'];

//Redirect to MyPage(link.php)
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']));
$extra = 'link.php';
//header("Location: http://$host$uri/$extra");
//exit;


$next_page = "http://".$host.$uri."/".$extra;
echo $next_page;
echo $_SESSION['email'];
 
echo <<< EOM
ユーザーID変更しました。<br />
<a href="{$next_page}" >リンク登録へ<a/>
EOM;



function is_mail($text) {
	if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $text)) {
		return TRUE;
	} else {
		return FALSE;
	}
}
?>