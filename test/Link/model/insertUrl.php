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

//Step1
$stmt = $pdo->prepare(
		"INSERT INTO Link(email, url, name, tag) VALUES(:email, :url, :name, :tag)"
);

$SqlParam = array('url' => '','name' => '', 'tag' =>'');
$SqlParam["url"]   = $_SESSION['url'];
$SqlParam["name"]  = $_SESSION['name'];
$SqlParam["tag"]   = $_SESSION['tag'];

$email  =  $_SESSION['email'];
$url    =  $SqlParam["url"];
$name   =  $SqlParam["name"];
$tag    =  $SqlParam["tag"];

$stmt->bindParam(":email", $email);
$stmt->bindParam(":url", $url);
$stmt->bindParam(":name", $name);
$stmt->bindParam(":tag", $tag);
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



?>