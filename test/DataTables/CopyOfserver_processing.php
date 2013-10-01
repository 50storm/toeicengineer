<?php
mb_language("japanese");
mb_internal_encoding("UTF-8");

//try {
    // MySQLサーバへ接続
    $pdo = new PDO("mysql:dbname=toeicengineer_db;host=localhost",
	"toeicengineer", "abc");
	
    $stmt = $pdo->prepare("SELECT * FROM toeic_score order by date");
    $stmt->execute();
    $rows=array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
   	 
    	 $rows=$row;
    	 echo $rows["date"];
    	 echo $rows["total"];
    	 echo $rows["listening"];
    	 echo $rows["reading"];
    	 echo $rows["comment"];
    }
    echo count($row = $stmt->fetch(PDO::FETCH_ASSOC));
    
   
    
    
    
    
     
   // $rows = array();
    
    
    
    /*
     * Output
    */
/*
    $_GET['sEcho']=1;
    $iTotal=5;
    $iFilteredTotal=5;
    
    $output = array(
    		"sEcho" => intval($_GET['sEcho']),
    		"iTotalRecords" => $iTotal,
    		"iTotalDisplayRecords" => $iFilteredTotal,
    		"aaData" => array()
    );
    
    
    echo count($stmt->fetch(PDO::FETCH_ASSOC));
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      //$rows[] = $row;
    	$output["aaData"] = $row;
    }
    
  *?  
   // $output["iTotalRecords"]=count($stmt->fetch(PDO::FETCH_ASSOC);
   // $output["iTotalDisplayRecords"]=count($stmt->fetch(PDO::FETCH_ASSOC);
    
    
    var_dump($output);
    
    // 宣言｢このファイルphpではなく､jsonとして扱いなさい！｣
    //header('Content-Type:application/json');
    // データをjsonに変換して出力
    echo json_encode($rows);
        
//} catch(PDOException $e){
//    var_dump($e->getMessage());
//}

// 切断
$pdo = null;
