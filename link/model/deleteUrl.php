<?php
session_start();
mb_language("japanese");
mb_internal_encoding("UTF-8");
require_once('../Class/Utility.php');
//チェック
if (empty($_POST['url'])) {
	print('URLが入力されていません。');
	exit();
}

if (empty($_POST['name'])) {
	print('表示名が入力されていません。');
	exit();
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
			"delete from toeicengineer_db.Link where seq=:seq"
	);
	$seq   = $_SESSION['seq'];
	$stmt->bindParam(":seq"  , $seq);
	$stmt->execute();
}catch(PDOException $e){
	echo $e->getMessage();
	exit;

}

//マイページへリダイレクト
$Uri=Utility::makeUrlController('view_controller.php?page=myPage');
header("Location: $Uri");
exit;
?>