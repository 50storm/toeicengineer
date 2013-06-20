<?php
mb_language("japanese");
mb_internal_encoding("UTF-8");
//$_POST['name属性']
if(empty($_POST['emailHeader'])) {
    print "<html>";
    print "<head>";
    print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />";//error
    print "<title>アドレス未入力</title>";
    print "</head>";
    print "<body>";
    print "<p>アドレス未入力</p>";
    print "<p><a href=\"./mail.html\" >戻る</a></p>";
    print "</body>";
    print "</html>";
    exit("Mail Address is empty.");
}

if(empty($_POST['emailFooter'])) {
    print "<html>";
    print "<head>";
    print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />";//error
    print "<title>MailFooter未入力</title>";
    print "</head>";
    print "<body>";
    print "<p>MailFooter未入力</p>";
    print "<p><a href=\"./mail.html\" >戻る</a></p>";
    print "</body>";
    print "</html>";
    exit("Mail Address is empty.");
}


$to = $_POST['emailHeader']."@".$_POST['emailFooter'];
$subject = $_POST['subject'];
$body = $_POST['message'];
$from = mb_encode_mimeheader(mb_convert_encoding("toeicengineer","JIS","UTF-8"))."<mail@toeicengineer.sakura.ne.jp>";
$success = mb_send_mail($to,$subject,$body,"From:".$from);

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>電子メールを送信する</title>
</head>

<body>
<div id="wrap">
<div id="head">
<!--
<h1>メールメモ完了</h1>
-->
</div>
<div id="content">
<!--<p style="margin-top: 200px">-->
<?php
if ($success) {
	print "<h1  style=\"font-size: large;background-color:aqua;\">送信しました</h1>";
	print "<p>$subject</p>";
	print "<p>$body</p>";
} else {
	print "<h1>送信失敗</h1>";
}
?>
</p>
</div>

<div id="foot">

</div>

</div>
</body>
</html>
