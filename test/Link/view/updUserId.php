<?php
session_start();
mb_language("japanese");
mb_internal_encoding("UTF-8");
$_SESSION['mode']='updUserId';
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
$pdo->query('SET NAMES UTF8');//SQL実行
$stmt =$pdo->prepare("SELECT * FROM toeicengineer_db.userid WHERE email =:email");
$email=$_SESSION['email'];
$stmt->bindParam(":email", $email);
$stmt->execute();//execute()しないとfetchできない
$row=$stmt->fetch();

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
		background-color:white;
		width:100px;
		}

</style>
<title>ユーザーID変更</title>
</head>
<body>
<div id="wrap">
	<div id="head">
		<h1>ユーザーID変更</h1>
	</div>
	<div id="content">
		<h2>ユーザーID変更</h2>
		<form id="frmInput" name="frmInput" action="../validater/validateUpdUserId.php">
			<div class="input">
				<label for="userId_old" class="input" >旧ユーザーID</label>
				<input name="userId_old" type="text" id="userId_old" size="35" value="<?php echo $row['userId'];?>" readonly />
			</div>
			<div class="input">
				<label for="userId" class="input" >新ユーザーID</label>
				<input name="userId" type="text" id="userId" size="35" value="" />
			</div>
			<div class="input">
				<label for="password" class="input">パスワード</label>
				<input name="password" type="password" id="password" size="35"   value=""  />
			</div>
			<br/>
			<div class="input">
				<input  type="submit" value="変更する" />
			</div>
		</form>
	</div>
</div>
</body>
</html>
