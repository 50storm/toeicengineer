<?php
//http://codezine.jp/article/detail/433?p=2
//http://www.php-labo.net/tutorial/class/pdo.html
$dsn = 'mysql:dbname=toeicengineer_db;host=mysql464.db.sakura.ne.jp';
$user = 'toeicengineer';
$password = 'hiro1128';

try{
	//Cpmmect
    $pdo = new PDO($dsn, $user, $password);
    $pdo->query('SET NAMES UTF8');
	//print('connected:'.'<br>');
	//Query
	//$sql = 'select * from Category_Master ';
	/*
	$sql = 'SELECT *FROM Category_Master INNER JOIN Link ON Link.Category_Id = Category_Master.Id LIMIT 0 , 3';
    
	foreach ($pdo->query($sql) as $row) {
        print($row['Id']);
        print($row['Name'].'<br>');
		print($row['URL'].'<br>');
		
    }
	*/
	/*
	$sql = 'SELECT *FROM Category_Master INNER JOIN Link ON Link.Category_Id = Category_Master.Id LIMIT 0 , 3';
	$stmt =$pdo->query($sql);
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo implode(", ", $row) . PHP_EOL;
    }
	*/
	
	$sql = 'SELECT *FROM Category_Master INNER JOIN Link ON Link.Category_Id = Category_Master.Id LIMIT 0 , 3';
	$stmt =$pdo->prepare($sql);
	$stmt->execute();
	//$stmt->bindColumn("URL", $URL);
	//$stmt->fetch();
	//$rows=$stmt->fetch(PDO::FETCH_BOTH);
	//$i=0;
	while($rows=$stmt->fetch(PDO::FETCH_BOTH)){
		print($rows['URL'].'<br/>');
		//if ($i > 10){
		//	exit();
		//}
	}
	//var_dump($URL);
	//echo $URL;
	 
    $stmt = null;
	$pdo = null;
	
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}
