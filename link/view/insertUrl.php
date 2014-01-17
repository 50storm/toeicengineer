<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel='stylesheet' type='text/css' href='../css/com.css' />
<style>
div.input {
					display: block;
					width:1000px;
					height:30px;
					float: left;
					clear: left
					background-color:white;
				}
label.input{
		display: block;
		float: left;
		clear: none;
		text-align: right;
		/*background-color:white;*/
		width:100px;
		}

</style>
<title>登録サンプル</title>
</head>
<body>
<div id="wrap">
	<div id="head">
		<h1>リンク登録</h1>
	</div>
	<div id="content">
		<h2>リンクを記入してください。</h2>
		<form id="frmInput" name="frmInput" method="post" action="../model/insertUrl.php">
			<div class="input">
				<label for="url" class="input" >URL</label>
				<input name="url" type="text" id="url" />
			</div>
			<div class="input">
				<label for="name" class="input" >表示名</label>
				<input name="name" type="text" id="name" size="35" />
			</div>
			<div class="input">
				<label for="tag" class="input">タグ</label>
				<input name="tag" type="text" id="tag" size="35" />
			</div>
			<br/>
			<div>
				<input  type="submit" value="登録する" />
			</div>
		</form>
	</div>
</div>
</body>
</html>
