<html>
<head><title>PHP TEST</title></head>
<body>

<?php
require('Util.php');

$dsn = 'mysql:dbname=toeicengineer_db;host=localhost';
//$user = 'toeicengineer';
//$password = 'abc';
$user = 'root';
$password = '';

//try{
    $pdo = new PDO($dsn,$user,$password);
    $stmt = $pdo->query("SELECT * FROM link");
	$objUtil = new Util();
    while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
    	//var_dump($rows);
    	//echo implode(", ", $rows) . PHP_EOL;
    	//var_dump($rows['URL']);
    	//var_dump($rows['Name']);
    	//var_dump($rows['Target']);
    	//var_dump($rows['Title']);
    	$ret=$objUtil->MakeLink($rows['URL'],$rows['Name'],$rows['Target'],$rows['Title']);
		echo $ret;
		//echo "<a href=". $rows['URL'] ." Title='".$rows['Title'] ."'" .$rows['Name']."</a>";
		echo "<br/>";
		print PHP_EOL;
     }
    
//}catch (PDOException $e){
//    var_dump('Error:'.$e->getMessage());
//    die();
//}

$pdo = null;

?>

</body>
</html>
