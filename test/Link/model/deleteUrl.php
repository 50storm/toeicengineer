<?php
session_start();
mb_language("japanese");
mb_internal_encoding("UTF-8");
/*
$url = $_POST['url'];
$name = $_POST['name'];
$label = $_POST['label'];
$memo =$_POST['memo'];
$tooltips = $_POST['tooltips'];
*/



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

//$stmt = $pdo->prepare(
//		"delete from toeicengineer_db.Link where email=:email and url=:url"
//);
//$SqlParam = array('email' => '','url' => '');
//$SqlParam["email"]   = $_SESSION['email'];
//$SqlParam["url"]     = $_SESSION['url'];
//$stmt->bindParam(":email", $SqlParam["email"]);
//$stmt->bindParam(":url"  , $SqlParam["url"]);
//$stmt->execute();

$stmt = $pdo->prepare(
		"delete from toeicengineer_db.Link where seq=:seq"
);
$seq   = $_SESSION['seq'];
$stmt->bindParam(":seq"  , $seq);
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
URL削除しました。<br />
<a href="{$next_page}" >MyPageへ<a/>
EOM;

?>