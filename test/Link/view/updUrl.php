<?php
session_start();
mb_language("japanese");
mb_internal_encoding("UTF-8");
//modelコントローラーへのパラメーター
$_SESSION['mode']='updUrl';
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
$stmt =$pdo->prepare("SELECT * FROM toeicengineer_db.link WHERE seq =:seq");
$seq=$_SESSION['seq'];
$stmt->bindParam(":seq", $seq);
$stmt->execute();//execute()しないとfetchできない
$row=$stmt->fetch();

//セッションで渡す(キー値)
//$_SESSION['url']   = $row['url']   ;
//$_SESSION['email'] = $row['email'] ;

//var_dump($row);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel='stylesheet' type='text/css' href='../css/com.css' />
<style>
div.input {
					display: block;
					width:1000px;
					height:30px;
					float: left;
					clear: left
					background-color:white;
				}
label.input{
		display: block;
		float: left;
		clear: none;
		text-align: right;
		/*background-color:white;*/
		width:100px;
		}

</style>
<title>ブックマーク変更</title>
</head>
<body>
<div id="wrap">
	<div id="head">
		<h1>ブックマーク変更</h1>
	</div>
	<div id="content">
		<h2>変更内容を入力。</h2>
		<form id="frmInput" name="frmInput" method="post" action="../model/updateUrl.php">
			<div class="input">
				<label for="url" class="input" >URL</label>
				<input name="url" type="text" id="url" value="<?php echo $row['url'];?>" />
			</div>
			<div class="input">
				<label for="name" class="input" >表示名</label>
				<input name="name" type="text" id="name" size="35" value="<?php echo $row['name']; ?>"/>
			</div>
			<div class="input">
				<label for="tag" class="input">タグ</label>
				<input name="tag" type="text" id="tag" size="35" value="<?php echo $row['tag'];?>"/>
			</div>
			<br/>
			<div>
				<input  type="submit" value="変更" />
			</div>
		</form>
	</div>
</div>
</body>
</html>
