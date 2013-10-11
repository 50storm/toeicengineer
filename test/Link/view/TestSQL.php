<?php
if ($_SERVER['HTTP_HOST'] == 'localhost'){
	$dsn      = 'mysql:dbname=toeicengineer_db;host=localhost';
	$user     = 'toeicengineer';
	$password = 'abc';
}else{
	$dsn      ='mysql:dbname=toeicengineer_db;host=mysql464.db.sakura.ne.jp';
	$user     ='toeicengineer';
	$password ='hiro1128';
}

	define('PEAR_PAGE' , 5);
	if (isset($_GET['page'])){
		if(preg_match('/^[1-9][0-9]*$/' , $_GET['page'])){
			$page= (int)$_GET['page'];
		}else{
			$page=1;
		}
	}else{
			$page=1;
	}
	
	//select * from table limit offset, count
	//offset=from count=個数
	//page offset count
	//1		0		5
	//2		5		5
	//3		10		5
	
	$offset         = PEAR_PAGE*($page-1);
	var_dump($offset);
	$pdo_bookmark   = new PDO($dsn, $user, $password);
	$sql_bookmark   ="SELECT * FROM toeicengineer_db.link WHERE email =:email limit ".$offset.",".PEAR_PAGE; 
	$stmt=$pdo_bookmark->prepare($sql_bookmark);
	$stmt->bindParam(":email", $email);
	$email='iga1128@gmail.com';
	$stmt->execute();
	//$stmt->fetch();
	//var_dump($sql_bookmark);
	//$bookmars       = array()
	$bookmarks=$stmt->fetch();
	foreach($bookmarks as $row){
		array_push($bookmarks,$row);
	}
	$stmt=$pdo_bookmark->prepare("select count(*) from toeicengineer_db.link WHERE email =:email ");
	$stmt->bindParam(":email", $email);
	$email='iga1128@gmail.com';
	$stmt->execute();
	$total     = $stmt->rowCount();
	$totalPage = ceil($total/PEAR_PAGE);

?>
<!DOCTYPE HTML>
<html>
<head>
<title>マイページ</title>
<style>
</style>
</head>
<body>
<div id="wrapper">
	<div id="bookmarks" class="box">
		<h2 class="headline">ブックマーク</h2>
		<ul>
			<?php foreach($bookmarks as $bookmark) : ?>
			<li><?php echo htmlspecialchars($bookmark['url'],ENT_QUOTES,'UTF-8'); ?> </li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php for ($i = 1 ; $i <= $totalPage ; $i++) : ?>
	<a href="?page=<?php echo $i; ?>"><?php echo $i?></a>
	<?php endfor; ?>
</div>
</body>
</html>