<?php
mb_language("japanese");
mb_internal_encoding("UTF-8");

//try {

//$_GET['sEcho']=1;

$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => 0,
		"iTotalDisplayRecords" => 20,
		"aaData" => array()
);



// MySQLサーバへ接続
$pdo = new PDO("mysql:dbname=toeicengineer_db;host=localhost",
	               "toeicengineer",
    		        "abc"
               );
    
$stmt = $pdo->prepare("SELECT * FROM toeic_score order by date");
$stmt->execute();
$rows=array();

foreach($stmt->fetch(PDO::FETCH_NUM as row){
	
	
	
}
while($row = $stmt->fetch(PDO::FETCH_NUM )){
   	 
    	 $rows=$row;
}
    $output["aaData"][]  = $rows;
    
    
    $count=$stmt->rowCount();
 	//echo $count;
   
 	$pdoCnt = new PDO("mysql:dbname=toeicengineer_db;host=localhost",
 			"toeicengineer",
 			"abc"
 	);
 	
 	$stmtCnt = $pdoCnt->query("SELECT COUNT(*) FROM toeic_score");
 	//echo $stmtCnt->fetchColumn(); //件数が表示される
    $output["iTotalRecords"] =  intval($stmtCnt->fetchColumn());
    echo "debug->" .$output["iTotalRecords"];
    


    
  
   // $output["iTotalRecords"]=count($stmt->fetch(PDO::FETCH_ASSOC);
   // $output["iTotalDisplayRecords"]=count($stmt->fetch(PDO::FETCH_ASSOC);
    
    
    var_dump($output);
    
    // 宣言｢このファイルphpではなく､jsonとして扱いなさい！｣
    //header('Content-Type:application/json');
    // データをjsonに変換して出力
    echo json_encode($output);
        
//} catch(PDOException $e){
//    var_dump($e->getMessage());
//}

// 切断
$pdo = null;
