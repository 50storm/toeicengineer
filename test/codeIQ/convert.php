<?php
mb_language("japanese");
mb_internal_encoding("UTF-8");
if(!empty($_POST['jusho'])) {
	$jyusyo_zenkaku = toZenkaku($_POST['jusho']);
}
//全角に変換
function toZenkaku($input){
	$output="";
	if (empty($input))
	{
		$output="";
	}else{
		$output="";
		$output = mb_convert_kana($input, "ASKV","UTF-8");
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
        <form action="convert.php" method="post">
            <p>住所<input type="text" name="jusho" size="40" value="<?php echo $jyusyo_zenkaku; ?>"></p>
            <input type="submit" value="変換">
        </form>
</body>
</html>
