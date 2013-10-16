<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
		background-color:white;
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
	<p><h2>リンクを記入してください。<h2></p>
	<form id="frmInput" name="frmInput" method="post" action="inputUrl.php">
		<div class="input">
			<label for="url" class="input" >URL</label>
			<input name="url" type="text" id="url" />
		</div>
		<div class="input">
			<label for="name" class="input" >表示名</label>
			<input name="name" type="text" id="name" size="35" />
		</div>
		<div class="input">
			<label for="label" class="input">ラベル</label>
			<input name="label" type="text" id="label" size="35" />
		</div>
		<div class="input">
			<label for="memo" class="input">メモ</label>
			<input name="memo" type="text" id="memo" size="35" />
		</div>
		<div class="input">
			<label for="tooltips" class="input">ツールチップ</label>
			<input name="tooltips" type="text" id="tooltips" size="35" />
		</div>
		<div>
			<input  type="submit" value="登録する" />
		</div>
	</form>
</div>
</body>
</html>
