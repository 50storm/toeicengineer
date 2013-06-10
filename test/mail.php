<?php
mb_language("japanese");
mb_internal_encoding("UTF-8");
if(empty($_POST['emailHeader']) || empty($_POST['emaiFooter']) )  {
    print "<html>";
    print "<head>";
    print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />";//error
    print "<title>Mail未入力</title>";
    print "</head>";
    print "<body>";
    print "<p>emailHeader</p>";
    print "<p><a href=\"./input.php\" >put MailHeader</a></p>";
    print "</body>";
    print "</html>";
    exit("Mail Address is empty.");
}

if (!empty($_POST['email'])) {
	$to = $_POST['email'];
	$subject = $_POST['subject'];
	$body = $_POST['message'];
	$from = mb_encode_mimeheader(mb_convert_encoding("50嵐","JIS","UTF-8"))."<iga1128@msn.com>";
	$success = mb_send_mail($to,$subject,$body,"From:".$from);
}
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
<h1>電子メールを送信する</h1>
</div>

<div id="content">
<p style="margin-top: 200px">
<?php
if ($success) {
	print('送信しました');
} else {
	print('送信に失敗しました');
}
?>
</p>
</div>

<div id="foot">
<p><img src="images/txt_copyright.png" width="136" height="15" alt="(C) H2O Space. MYCOM" /></p>
</div>

</div>
</body>
</html>
