﻿<!DOCTYPE HTML>
<html>
<head>
<title>TOEIC950点(リスニグ満点)エンジニアのHP</title>
<meta name="msvalidate.01" content="3558B7B63588B2A68C97ECF07E3FF0D2" />
<meta charset="UTF-8" />
<meta content="text/html; charset=UTF-8" http-equiv="content-type" />
<meta name="keywords" content="TOEIC,エンジニア" /> 
<meta name="description" content="TOEIC950点(リスニグ満点)エンジニアのHP"/>
<meta name="robots" content="index,follow"/>
<!--<script type="text/javascript" src="jQuery/jquery-1.6.1.min.js"></script>-->
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">
	google.load("jquery", "1.6.1");
</script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
	$(function() {
		$( document ).tooltip();
	});
</script>
<link rel="stylesheet" href="Css/Menu.css" type="text/css">
<link rel="stylesheet" href="Css/Wrap.css" type="text/css">
<link rel="stylesheet" href="Css/Link.css" type="text/css">
</head>
<body>
<div id="wrapper">
	<div id="header">
		<h1><strong>TOEIC</strong>950点(リスニグ満点)エンジニアのHP</h1>
	</div>
	<div id="menu" >
		<ul id="dropMenu">
			<li><a href="index.html">Home</a></li>
			<li><a href="http://toeicengineer.blogspot.jp/" target="_blank">Blog</a></li>
			<li><a href="link.html" >Link</a></li>
		</ul>
	</div>
	<div id="box1" class="box">
		<h2 class="headline">TOEIC Engineer Link</h2>
		<ul>
			<?php
			//http://codezine.jp/article/detail/433?p=2
			//http://www.php-labo.net/tutorial/class/pdo.html
			require('Util.php');
			$dsn = 'mysql:dbname=toeicengineer_db;host=mysql464.db.sakura.ne.jp';
			$user = 'toeicengineer';
			$password = 'hiro1128';
			
			try{
				$pdo = new PDO($dsn, $user, $password);
				$pdo->query('SET NAMES UTF8');
				//$sql = 'SELECT *FROM Category_Master INNER JOIN Link ON Link.Category_Id = Category_Master.Id LIMIT 0 , 3';
				$sql = 'SELECT *FROM Link;';
				$stmt =$pdo->prepare($sql);
				$stmt->execute();
				$objUtil = new Util();
				
				while($rows=$stmt->fetch(PDO::FETCH_BOTH)){ 
					print('<li>');
					$ret=$objUtil->MakeLink($rows['URL'],$rows['Name'],$rows['Blank'],$rows['Title']);
					print($ret);
					print('</li>');
				}
				$stmt = null;
				$pdo = null;
			}catch (PDOException $e){
				print('Error:'.$e->getMessage());
				die();
			}
			?>
		</ul>
	</div>
	<div id="footer">
	<p>Copyright 2013<strong>Hiroshi Igarashi</strong></p>
	<a href="http://toeicengineer.blogspot.jp/" target="_blank">TOEIC950点(リスニング満点) わすれっぽいエンジニアブログです。</a>
	</div>
</div>
</body>
</html>