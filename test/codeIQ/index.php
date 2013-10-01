<?php
    mb_language("japanese");
    mb_internal_encoding("UTF-8");
    //初期表示
    $input="";
    //全角に変換
    function toZenkaku($input){
    	
    	//初期表示のときは何もしない
    	if (empty($input) && empty($_POST['jusho']) ){
    		return "";
    	}
    	
    	//フォームから受け取った住所があればコンバート
    	$output;
    	$jyusyo=$_POST['jusho'];
    	 
    	if (empty($jyusyo))
    	{
    		$output="";
    	}else{
    		$output="";
    		$output = mb_convert_kana($jyusyo, "ASKV","UTF-8");
    	}
    	return htmlspecialchars($output);
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset='UTF-8' />
<title>全角変換フォーム</title>
</head>
<body>
        <form action="index.php" method="post">
            <p>
            住所<input type="text" name="jusho" size="40" value="<?php echo toZenkaku($input); ?>">
            </p>
            <input type="submit" value="変換">
        </form>
</body>
</html>