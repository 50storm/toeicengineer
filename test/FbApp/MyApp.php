<?php

// appId
$appId = '389032904549748';
// secret
$secret = '7aaa314dc85dcdc87779e54aae71255f';
// access_token
$access_token = '';

// PHP SDKを読み込む
require_once './src/facebook.php';

$facebook = new Facebook(
				array(
						'appId' => $appId, 
						'secret' => $secret
					)
			);
// Facebookオブジェクト生成時にappId、secretを指定しなくても取得可（取得時のパラメータにaccess_tokenを指定するため）
//$facebook = new Facebook(array());

$feed = $facebook->api('/me/feed/', 'GET', array('access_token' => $access_token));

// 結果を出力
var_dump($feed);

?>