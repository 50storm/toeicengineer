<?php
session_start();


if ($_SERVER['HTTP_HOST'] == 'localhost'){
	require_once('./Class/Utility.php');
	$dsn      = 'mysql:dbname=toeicengineer_db;host=localhost;charset=utf8;';
	$user     = 'toeicengineer';
	$password = 'abc';
}else{
	require_once('./Class/Utility.php');
	$dsn      ='mysql:dbname=toeicengineer_db;host=mysql464.db.sakura.ne.jp;charset=utf8';
	$user     ='toeicengineer';
	$password ='hiro1128';
}

/*
TODO　
*/
//SESSIONにemailがなければログインしてないとする
$_SESSION['email']="iga1128@gmail.com";
if(empty($_SESSION['email'])){
	echo "ログインしてください";
	$uri=Utility::makeUrlController('view_controller.php?page=login');
	header("Location: $uri");
	exit;
}
//echo $_SESSION['email'];
mb_language("japanese");
mb_internal_encoding("UTF-8");
mb_http_output("utf-8");
//echo mb_internal_encoding();


//var_dump($dsn);
//ブックマーク登録
$page_bookmark =Utility::makeUrlController('view_controller.php?page=login&action=insertUrl');
var_dump($page_bookmark);
//ユーザーID変更
$page_config   =Utility::makeUrlController('view_controller.php?page=updUserId');
//表示名を変更
$page_updUrl   =Utility::makeUrlController('view_controller.php?page=updateUrl');
//削除
$page_delUrl   =Utility::makeUrlController('view_controller.php?page=delUrl');

//$uri           = rtrim(dirname(dirname($_SERVER['PHP_SELF']))).'/view/myPage.php';
//$page_selTag   = "http://".$host.$uri;
$page_selTag   =Utility::makeUrlView('link.php');
//var_dump($page_selTag);
//tagで抽出
$bGetFlag=false;

if (isset($_GET['page'])){
	if(preg_match('/^[1-9][0-9]*$/' , $_GET['page'])){
		$page= (int)$_GET['page'];
	}else{
		$page=1;
	}
}else{
		$page=1;
}
//var_dump($page);
//var_dump($_GET);
//var_dump($_GET['tag']);
//var_dump($_GET['page']);
define('PER_PAGE', 10);//1ページ当たり
$offset   = PER_PAGE*($page-1);
$pdo_bookmark  =null;
$sql_bookmark  ="";
$stmt_bookmark=null;
$count_bookmark=0;
//タグがありなしで処理を分岐
//タグがあるかなしは、GETパラメータで判断
//初期表示は当然GETなし
if (isset($_GET['tag'])){
//タグをクリックしたとき
	$bGetFlag=true;
	$pdo_bookmark  = new PDO($dsn, $user, $password);
	$sql_bookmark   ="SELECT * FROM toeicengineer_db.link WHERE email =:email AND tag =:tag"." limit ".$offset.", 5";;
	$stmt_bookmark = $pdo_bookmark->prepare($sql_bookmark);
	$email=$_SESSION['email'];
	$tag  =$_GET['tag'];
	$stmt_bookmark->bindParam(":email", $email);
	$stmt_bookmark->bindParam(":tag", $tag);
	$stmt_bookmark->execute();//execute()しないとfetchできない
	$count_bookmark=$stmt_bookmark->rowCount();
		//ここでFetchさせて$bookmarksに格納しておく
	//foreachでピンポイントで展開
	$bookmarks=array();
	while($row=$stmt_bookmark->fetch()){
		array_push($bookmarks,$row);
	}
	
	
	//ページング処理
	$sql_bookmark   ="SELECT * FROM toeicengineer_db.link WHERE email =:email AND tag =:tag";
	$stmt_bookmark  = $pdo_bookmark->prepare($sql_bookmark);
	$email=$_SESSION['email'];
	$tag  =$_GET['tag'];
	$stmt_bookmark->bindParam(":email", $email);
	$stmt_bookmark->bindParam(":tag", $tag);
	$stmt_bookmark->execute();//execute()しないとfetchできない
	$total_bookmark=$stmt_bookmark->rowCount();
	$totalPage   =  ceil($total_bookmark/PER_PAGE);
	
	
}else{
	$bGetFlag=false;
	$pdo_bookmark   = new PDO($dsn, $user, $password);
	$sql_bookmark   ="SELECT * FROM toeicengineer_db.link WHERE email =:email"." limit ".$offset.",".PER_PAGE;
	$stmt_bookmark  = $pdo_bookmark->prepare($sql_bookmark);
	$email=$_SESSION['email'];
	$stmt_bookmark->bindParam(":email", $email);
	$stmt_bookmark->execute();//execute()しないとfetchできない
	$count_bookmark=$stmt_bookmark->rowCount();
	//ここでFetchさせて$bookmarksに格納しておく
	//foreachでピンポイントで展開
	$bookmarks=array();
	while($row=$stmt_bookmark->fetch()){
		array_push($bookmarks,$row);
	}
	

	//ページング処理
	$sql_bookmark   ="SELECT * FROM toeicengineer_db.link WHERE email =:email";
	$stmt_bookmark  = $pdo_bookmark->prepare($sql_bookmark);
	$email=$_SESSION['email'];
	$stmt_bookmark->bindParam(":email", $email);
	$stmt_bookmark->execute();//execute()しないとfetchできない
	$total_bookmark=$stmt_bookmark->rowCount();
	$totalPage   =  ceil($total_bookmark/PER_PAGE);
	
	
}

//tag取得
$pdo_tag   = new PDO($dsn, $user, $password);
$stmt_tag  =$pdo_tag->prepare("SELECT DISTINCT tag FROM toeicengineer_db.link WHERE email =:email");
$email     =$_SESSION['email'];
$stmt_tag->bindParam(":email", $email);
$stmt_tag->execute();
$flgData;//ブックマークがあるかないかのフラグ
if (intVal($stmt_tag->rowCount()) == 0) {
	$flgData=false;
}else{
	$flgData=true;
	//タグを持ってくる
	$tags=array();
	while($row=$stmt_tag->fetch()){
		array_push($tags,$row);
	}
}


//タグ表示用
$pdo_tag_counter = new  PDO($dsn, $user, $password);
$stmt_tag_counter =$pdo_tag_counter->prepare("SELECT COUNT(tag) as count_tag FROM toeicengineer_db.link WHERE email =:email AND tag =:tag");
$email=$_SESSION['email'];
$tag = $row['tag'];
$stmt_tag_counter->bindParam(":email", $email);
$stmt_tag_counter->bindParam(":tag"  , $tag);
$stmt_tag_counter->execute();
$row_tag_counter=$stmt_tag_counter->fetch();

?>
<!DOCTYPE HTML>
<html>
<head>
<title>TOEIC950点(リスニグ満点)わすれっぽいエンジニアのHP</title>
<meta name="msvalidate.01" content="3558B7B63588B2A68C97ECF07E3FF0D2" />
<meta charset="UTF-8" />
<meta content="text/html; charset=UTF-8" http-equiv="content-type" />
<meta name="keywords" content="TOEIC,エンジニア" /> 
<meta name="description" content="TOEIC950点(リスニグ満点)わすれっぽいエンジニアのHP"/>
<meta name="robots" content="index,follow"/>
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">
	google.load("jquery", "1.6.1");
</script>
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">
	google.load("jquery", "1.6.1");
</script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="./script/jquery.dataTables.js" type="text/javascript"></script>

<script>
	$(function() {
		$( document ).tooltip();
	});
/*
	$(function() {
	   $('#linkTable').dataTable(
					{
						"aLengthMenu": [5, 10, 15,20,-1],
						"iDisplayLength": 30
					}
		)
	});
*/

</script>
<link rel="stylesheet" href="./Css/Menu.css" type="text/css">
<link rel="stylesheet" href="./Css/Wrap.css" type="text/css">
<!--<link rel="stylesheet" href="./Css/Link.css" type="text/css">
-->

<link rel="stylesheet" href="./Css/demo_table.css" type="text/css">
<link rel="stylesheet" href="./Css/demo_page.css" type="text/css">
<style>
/*DIV*/

/*タグ(ラベル)*/
#Lables{
	float:left;
	width:200px;
	/*border: 1px solid lime;*/
}
/*ブックマーク(リンク)*/
#link{
	float:left;
	/*border: 1px solid #FFFF00;*/
	width:600px;

}
/*右側スペース(広告予定)*/
#rightSpace{
	float:right;
	width:50px;
	/*
	background-color:gray;
	*/
}
/*フッター*/
#footer{
	clear:left;
}

/*ブックマーク(リンク)装飾*/
#link table{
	tablepx-layout:auto;
	width:600px;
}
#link table caption{
	text-decoration:underline;
	text-align:left;
	width:200px;
	/*background-color:#00FFFF;*/
}
#link table th{
	height:30px;
	border: 1px #2b2b2b solid;
	background-color:#CCFFFF;
}
#link td,tr{
	width: 40%;
	/*
	text-align: left;
	*/
	
	border: 1px #2b2b2b solid;
	
}

/*メニューしたのアンダーライン*/
.headline{
	text-decoration:underline;
}

/*ラベル(タグ)にアイコン設定*/
ul.tag{
	list-style-image: url(./img/icon_tag.png);
}
h2{
	font-size: 95%;
	margin:0px;
	height:12px;
	text-decoration:underline;
	/*
	background-color:#00FFFF;
	*/
}
</style>
</head>
<body>
<div id="wrapper">
	<div id="header">
	
		<?php include"header.html"; ?>
			
	</div>
	<div id="menu" >
	
		<?php include"menu.html";  ?>
	
	</div>
	<div id="Lables">
		<h2>カテゴリー</h2>
		<?php if($flgData == false) :?>
			<p>ブックマークはありません。</p>
		<?php else :?>
			<ul class="tag" >
				<li>
					<a href="<?php echo Utility::h($page_selTag);?>">すべて表示</a>
				</li>
				<?php foreach ($tags as $value): ?>
					<?php $query=$page_selTag."?tag=".$value["tag"];?>
					<li>
						<a href="<?php echo Utility::h($query);?>"><?php echo Utility::h($value["tag"]); ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif ;?>
		<p><a href="<?php echo $page_bookmark  ?>" >ブックマーク登録</a></p>
	</div>
	<div id="link">
		<?php if($flgData == false) :?>
			
		<?php else :?>
			<table id="linkTable">
				<caption>Bookmarks</caption>
				<tbody>
					<th>カテゴリー</th><th>名前</th>
					<?php foreach ($bookmarks as $value): ?>
						<tr>
							<td><?php echo Utility::h($value["tag"]); ?></td>
							<td><a href="<?php echo Utility::h($value["url"]); ?>" target="_blank" title=""><?php echo Utility::h($value["name"]); ?></a></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			
			<?php if ($page > 1) : ?>
				<a href="?page=<?php echo $page-1; ?>">前</a>
			<?php endif; ?>
			<!--ページ番号-->
			<?php for ($i = 1 ; $i <= $totalPage ; $i++) : ?>
				<a href="?page=<?php echo Utility::h($i)?>"><?php echo Utility::h($i)?></a>
			<?php endfor ;?>
			<?php if ($page < $totalPage) : ?>
				<a href="?page=<?php echo $page+1; ?>">次</a>
			<?php endif; ?>
			
		<?php endif ;?>
	</div>
	<div id="rightSpace">
		<p></p>
	</div>
	<div id="footer">
		<?php include"footer.html"; ?>
	</div>
</div>
</body>
</html>