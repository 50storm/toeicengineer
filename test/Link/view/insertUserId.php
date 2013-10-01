<?php
session_start();
$_SESSION['mode']='insUserId';

//var_dump($_SERVER['HTTP_HOST']);

if (isset($_COOKIE["name"]))
	$name = $_COOKIE['name'];
else
	$name = '';
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
<title>アカウント情報登録</title>
</head>
<body>
<div id="wrap">
	<div id="head">
		<h1>アカウント情報登録</h1>
	</div>
	<div id="content">
		<h2>ブックマークでするメールアドレスとIDとパスワードを記入してください。</h2>
		<form id="frmInput" name="frmInput" method="post" action="../validater/validateUserId.php">
			<div class="input">
				<label for="email" class="input" >メールアドレス</label>
				<input name="email" type="text" id="email" value=""/>
			</div>
			<div class="input">
				<label for="userId" class="input" >ユーザーID</label>
				<input name="userId" type="text" id="userId" size="35" />
			</div>
			<div class="input">
				<label for="password" class="input">パスワード</label>
				<input name="password" type="text" id="password" size="35" />
			</div>
			<br/>
			<div class="input">
				<input  type="submit" value="登録する" />
			</div>
		</form>
	</div>
</div>
</body>
</html>
