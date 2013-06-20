<?php 
echo "*********POST データ確認*********<br />";
$emailHeader=$_POST['emailHeader'];
$emailFooter=$_POST['emailFooter'];
$subject=$_POST['subject'];
$message=$_POST['message'];

echo "$emailHeader <br />";
echo "$emailFooter <br />";
echo "$subject <br />";
echo "$message <br />";


echo "*********POST データ確認*********<br />";
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../Css/Menu.css" type="text/css">
<link rel="stylesheet" href="../Css/Wrap.css" type="text/css">
<title>メールメモ</title>
<style>
	h2{backGround-color:aqua; width:260px; }
</style>
<!--
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">
	google.load("jquery", "1.6.1");
</script>
-->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>

<script>

</script>
</head>
<body>
<div id="wraper">
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
	<h2>メールメモ</h2>
	<form id="form1" action="confirmForm.php" method="post">
	<p>
		<label for="MailAddress" a>メールアドレス:</label>
		<input name="emailHeader" type="text" id="emailHeader" size="10" value="<?php print(htmlspecialchars($emailHeader)); ?>" maxlength="255" />
		<label>@</label>
		<input name="emailFooter" type="text" id="emailFooter" size="10"  value="<?php print(htmlspecialchars($emailFooter)); ?>" maxlength="255" />
	</p>
	<p>
		<label>件名:</label>
		<input name="subject" type="text" id="subject" size="50" maxlength="255" value="<?php print(htmlspecialchars($subject)); ?>" />
	</p>
	<p>
		<label>メモ内容</label>
		<br/>
		<textarea name="message" id="message" cols="50" rows="10"><?php print(htmlspecialchars($message)); ?></textarea>
	</p>
	<input type="submit" value="メモる" id="submit"/>
	</form>
	<div id="footer" style="clear:both;">
		<hr>
		<p>Copyright 2013<strong>Hiroshi Igarashi</strong></p>
		<a href="http://toeicengineer.blogspot.jp/" target="_blank">TOEIC950点(リスニング満点) わすれっぽいエンジニアブログです。</a>
	</div>
</div>
<div id="dialog-message" title="Download complete">
<p>
<span class="ui-icon ui-icon-circle-check" style="float: left; margin: 0 7px 50px 0;"></span>
送信しますがよろしいですか？
</p>

</body>
</html>
