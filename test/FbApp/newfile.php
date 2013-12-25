<?php
//ユーザー名
$user = "hiroshi";
//Graph API URLです。詳細はhttp://developers.facebook.com/docs/reference/api/
$url = "http://graph.facebook.com/".$user."/posts";
//APIを実行
$body = file_get_contents($url);
//Jsonに変換する
$json = json_decode($body);

//検索結果を表示する
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
ユーザー名：<?php echo $user ?><br/><br/>
結果：<br/><br/>
●json表示:<br/>
<?php
print_r($json);
?>
<br/><br/>
●一覧表示:<br/>
<?php
foreach($json->data as $one){
  echo "{$one->message}</br>";
  echo "<a href='{$one->link}' />{$one->link}</a></br></br>";
}
?>
</body>
</html>
