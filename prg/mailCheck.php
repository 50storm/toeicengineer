<?php
mb_language("japanese");
mb_internal_encoding("UTF-8");

if (isset($_POST['send'])) {
	$emailHeader = $_POST['emailHeader'];
	$emailFooter = $_POST['emailFooter'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];
}
if (isset($_POST['rewrite'])) {
 
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../Css/Menu.css" type="text/css">
<link rel="stylesheet" href="../Css/Wrap.css" type="text/css">
<title>メールメモ</title>
<style>
	h2{backGround-color:red; width:300px; }
</style>
</head>
<body>
<div id="wrapper">
	<div id="header">
			<h1><strong>TOEIC</strong>950点(リスニグ満点)エンジニアのHP</h1>
		</div>
	<div id="menu" >
			<ul id="dropMenu"  style="">
				<li><a href="../index.html">Home</li>
				<li><a href="http://toeicengineer.blogspot.jp/" target="_blank">Blog</a></li>
				<li><a href="../link.html" >Link</a></li>
			</ul>
		</div>
	<h2>送信内容を確認してください</h2>
	<form action="mail.php" method="post">
	<p>
		<label for="MailAddress" a>メールアドレス:</label>
		<input readOnly name="emailHeader" type="text" id="emailHeader" size="10" value="<?php echo htmlspecialchars($emailHeader) ?>" maxlength="255"　　/>
		<label>@</label>
		<input readOnly name="emailFooter" type="text" id="emailFooter" size="10" value="<?php echo htmlspecialchars($emailFooter) ?>" maxlength="255" />
	</p>
	<p>
		<label>件名:</label>
		<input readOnly name="subject" type="text" id="subject" size="50" value="<?php echo htmlspecialchars($subject) ?>" maxlength="255"  />
	</p>
	<p>
		<label>メモ内容</label>
		<br/>
		<textarea readOnly name="message" id="message" cols="50" rows="10"　><?php echo htmlspecialchars($message) ?></textarea>
	</p>
	<input type="submit" value="メモる"  name="send" />
	<input type="submit" value="やり直す" name="rewrite"/>
	</form>
	<div id="footer" style="clear:both;">
		<hr>
		<p>Copyright 2013<strong>Hiroshi Igarashi</strong></p>
		<a href="http://toeicengineer.blogspot.jp/" target="_blank">TOEIC950点(リスニング満点) わすれっぽいエンジニアブログです。</a>
	</div>
</div>
</body>
</html>
