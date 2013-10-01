<?php
//http://temog.info/archives/programming/facebook-oauth-php.html
/***
 * 定数定義
 * 接続文字列
 * ***/
define('APP_ID', '389032904549748');
define('APP_SECRET', '7aaa314dc85dcdc87779e54aae71255f');
define('CALLBACK', 'http://toeicengineer.sakura.ne.jp/test/FbApp/callBack.php');
//define('CALLBACK', 'http://toeicengineer.sakura.ne.jp/test/FbApp/callBack.php');
//compose FaceBook URI
$authURL = 'http://www.facebook.com/dialog/oauth?client_id=' .
		APP_ID . '&redirect_uri=' . urlencode(CALLBACK);
//var_dump($authURL);
header("Location: " . $authURL);