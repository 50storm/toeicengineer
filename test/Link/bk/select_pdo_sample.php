<html>
<head><title>PHP TEST</title></head>
<body>

<?php

$dsn = 'mysql:dbname=toeicengineer_db;host=localhost';
$user = 'toeicengineer';
$password = 'abc';

//try{

    $pdo = new PDO($dsn,$usr,$password);
    $stmt = $pdo->query("SELECT * FROM link");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        //echo implode(", ", $row) . PHP_EOL;
        
    }


//}catch (PDOException $e){
//    var_dump('Error:'.$e->getMessage());
//    die();
//}

$dbh = null;

?>

</body>
</html>
