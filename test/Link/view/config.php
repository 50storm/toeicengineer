<?php
session_start();
mb_language("japanese");
mb_internal_encoding("UTF-8");

$dsn           = 'mysql:dbname=toeicengineer_db;host=localhost';
$user          = 'toeicengineer';
$password      = 'abc';

$host          = $_SERVER['HTTP_HOST'];
$uri           = rtrim(dirname(dirname($_SERVER['PHP_SELF']))).DIRECTORY_SEPARATOR.'controller';
$extra         = 'controller.php';
$page_control  = "http://".$host.$uri."/".$extra;
$page_mail     = "http://".$host.$uri."/".$extra.'?email=upd_view';
$page_userId   = "http://".$host.$uri."/".$extra.'?userId=upd_view';
$page_password = "http://".$host.$uri."/".$extra.'?password=upd_view';
var_dump($page_control);
var_dump( $page_mail );
var_dump( $page_userId );
var_dump( $page_password );



$pdo = new PDO($dsn, $user, $password);
$pdo->query('SET NAMES UTF8');//SQL実行

//$host  = $_SERVER['HTTP_HOST'];
//$uri   = rtrim(dirname(dirname($_SERVER['PHP_SELF']))).DIRECTORY_SEPARATOR.'form';
//$extra = 'inputUrl.php';
//$page_bookmark = "http://".$host.$uri."/".$extra;

$stmt =$pdo->prepare("SELECT * FROM toeicengineer_db.userid WHERE email =:email");
$email=$_SESSION['email'];
$stmt->bindParam(":email", $email);
$stmt->execute();//execute()しないとfetchできない
$row=$stmt->fetch();

$_SESSION['userId']   = $row['userId']
//$_SESSION['password'] = $row['password']
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
<title>アカウント情報</title>
</head>
<body>
<div id="wrap">
	<div id="head">
		<h1>アカウント情報</h1>
	</div>
	<div id="content">
		<h2>アカウント情報</h2>
		<form id="frmInput" name="frmInput" >
<?php
echo <<< EOM
			<div class="input">
				<label for="email" class="input" >メールアドレス</label>
				<input name="email" type="text" id="email" value="{$row['email']}"/>
				<a href="{$page_mail}">変更</a>
			</div>
			<div class="input">
				<label for="userId" class="input" >ユーザーID</label>
				<input name="userId" type="text" id="userId" size="35" value="{$row['userId']}" />
				<a href="{$page_userId}">変更</a>
			</div>
			<div class="input">
				<label for="password" class="input">パスワード</label>
				<input name="password" type="password" id="password" size="35"  value="{$row['password']}"  />
				<a href="{$page_password}">変更</a>
			</div>
			<br/>
			<div class="input">
				<input  type="submit" value="変更する" />
			</div>
EOM;
?>
		</form>
	</div>
</div>
</body>
</html>
