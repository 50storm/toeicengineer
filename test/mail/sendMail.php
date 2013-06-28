<?php
require_once("Mail.php");

$params = array(
  "host" => "xxx.xxx.xx",
  "port" => 587,
  "auth" => true,
  "username" => "xxx@xxx.xxx.xx",
  "password" => "xxxxxxxxx"
);

$mailObject = Mail::factory("smtp", $params);

$recipients = "xxx@xxx.xxx.xx";
$headers = array(
  "To" => "iga1128@msn.com",
  "From" => "xxx@xxx.xxx.xx",
  "Subject" => mb_encode_mimeheader("")
);

$body = "testtest";
$body = mb_convert_encoding($body, "ISO-2022-JP", "auto");

$mailObject -> send($recipients, $headers, $body);

?>