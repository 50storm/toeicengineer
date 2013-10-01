<?php
session_start();
mb_language("japanese");
mb_internal_encoding("UTF-8");

//var_dump($_SESSION['url']);
//var_dump($_SESSION['email']);
//var_dump($_SESSION['name']);
//var_dump($_SESSION['tag']);
//var_dump($_SESSION['seq']);

//var_dump($_SERVER['HTTP_HOST']);
//var_dump($_SERVER['PHP_SELF']);
//var_dump(rtrim(dirname($_SERVER['PHP_SELF'])));
//var_dump(rtrim(dirname(dirname($_SERVER['PHP_SELF']))));


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
		"UPDATE toeicengineer_db.link 
		set 
			url=:url,
			name=:name,
			tag=:tag 
		where seq =:seq"
);

$seq       = $_SESSION['seq'];
$url       = $_SESSION['url'];
$name      = $_SESSION['name'];
$tag       = $_SESSION['tag'];

$stmt->bindParam(":seq"  , $seq);
$stmt->bindParam(":url"  , $url);
$stmt->bindParam(":name" , $name);
$stmt->bindParam(":tag"  , $tag);
$stmt->execute();


redirectTo(makeUrl('view_controller.php?page=myPage'));


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

