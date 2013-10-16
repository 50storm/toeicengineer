<?php 
//
//http://codezine.jp/article/detail/433?p=2
//http://www.php-labo.net/tutorial/class/pdo.html
require_once('../Class/Utility.php');
session_start();
//SESSIONにemailがなければログインしてないとする
if(empty($_SESSION['email'])){
	echo "ログインしてください";
	$uri=Utility::makeUrlController('view_controller.php?page=login');
	header("Location: $uri");
	exit;
}
//echo $_SESSION['email'];
mb_language("japanese");
mb_internal_encoding("UTF-8");

if ($_SERVER['HTTP_HOST'] == 'localhost'){
	$dsn      = 'mysql:dbname=toeicengineer_db;host=localhost';
	$user     = 'toeicengineer';
	$password = 'abc';
}else{
	$dsn      ='mysql:dbname=toeicengineer_db;host=mysql464.db.sakura.ne.jp';
	$user     ='toeicengineer';
	$password ='hiro1128';
}
//var_dump($dsn);
//ブックマーク登録
$page_bookmark =Utility::makeUrlController('view_controller.php?page=insertUrl');
//ユーザーID変更
$page_config   =Utility::makeUrlController('view_controller.php?page=updUserId');
//表示名を変更
$page_updUrl   =Utility::makeUrlController('view_controller.php?page=updateUrl');
//削除
$page_delUrl   =Utility::makeUrlController('view_controller.php?page=delUrl');
//$uri           = rtrim(dirname(dirname($_SERVER['PHP_SELF']))).'/view/myPage.php';
//$page_selTag   = "http://".$host.$uri;
$page_selTag   =Utility::makeUrlView('myPage.php');
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

$offset   = 5*($page-1);
$pdo_bookmark  =null;
$sql_bookmark  ="";
$stmt_bookmark=null;
$count_bookmark=0;
//タグがありなしで処理を分岐
//タグがあるかなしは、GETパラメータで判断
//初期表示は当然GETなし
if (isset($_GET['tag'])){
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
	$totalPage   =  ceil($total_bookmark/5);
	
	
}else{
	$bGetFlag=false;
	$pdo_bookmark   = new PDO($dsn, $user, $password);
	$sql_bookmark   ="SELECT * FROM toeicengineer_db.link WHERE email =:email"." limit ".$offset.", 5";
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
	$totalPage   =  ceil($total_bookmark/5);
	
	
}

//tag取得
$pdo_tag   = new PDO($dsn, $user, $password);
$stmt_tag  =$pdo_tag->prepare("SELECT DISTINCT tag FROM toeicengineer_db.link WHERE email =:email");
$email     =$_SESSION['email'];
$stmt_tag->bindParam(":email", $email);
$stmt_tag->execute();

//var_dump($page_bookmark);


?>
<!DOCTYPE HTML>
<html>
<head>
<title>マイページ</title>
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">
	google.load("jquery", "1.6.1");
</script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
	$(function() {
		$( document ).tooltip();
	});
</script>
<style>
/*リンク下線なし*/
a {
text-decoration: none;
}
/*600px  30px*/
div.itemcontent{
	/*border: 1px solid #FF0045;*/
	background-color:Azure;
	width:620px;
	height:30px;
	margin-top:2px;
	padding:5px;
}
div.iconBookmark{
	/*border: 1px solid #FF00FF;*/
	/*background-color:blue;*/
	/*padding:7.5px;*/
	float:left;
	width:15px;
	height:23px;
}

div.url{
	float:left;
	/*border: 1px solid blue;*/
	height:30px;
	width:480px;
}
div.edite{
	float:left;
	/*border: 1px solid #FF5050;*/
	/*background-color: #FF9900;*/
	text-align: center;
	height:30px;
	width:50px;
}

div.delete{
	float:left;
	/*border: 1px solid #FF5050;*/
	text-align: center;
	height:30px;
	width:50px;
}


div.url  a{
	text-align:left;
	vertical-align: middle;
	font-size:15px;
}


div.edite  a{
	text-align:center;
	vertical-align: middle;
	/*background-color: #FF99FF;*/
	font-size:15px;

}


div.delete  a{
	text-align:center;
	vertical-align: middle;
	font-size:15px;
}

.headline{
	line-height:2px;
}

a img {
	border: none;
}

ul.dropMenu{
	list-style-image: url(../img/icon_menu.png);
}

ul.dropMenu li{
	vertical-align:middle;
}

ul.tag{
	list-style-image: url(../img/icon_tag.png);
}
body{
	background-color:#CCFFFF;
}
</style>
</head>
<body>
<div id="wrapper">
	<div id="header">
		<p>ID：<?php echo Utility::h($_SESSION['userId']); ?></p>
		<h1>Bookmark</h1>
	</div>
	<div id="menu" >
	
		<ul id="dropMenu" class="dropMenu">
			<!--<li><a href="index.html">Home</a></li>-->
			<li><a href="<?php echo $page_bookmark  ?>" >ブックマーク登録</a></li>
			<li><a href="<?php echo $page_config    ?>" >登録内容変更</a></li>
		</ul>
	
	</div>
	<div id = "Lables">
		<h2 class="headline">タグ</h2>
		<?php 
			if (intVal($stmt_tag->rowCount()) == 0){
				echo '<p>ブックマークがありません</p>';
				echo '<a href="'      .$page_bookmark.    '">ブックマーク登録</a>';
			}else{
				echo '<ul class="tag" >';
				echo '	<li>';
				echo '		<a href="'.$page_selTag.'" target="">すべて表示</a>';
				echo '	</li> ';

				while($row=$stmt_tag->fetch()){
					//タグ分繰り返し
					$pdo_tag_counter = new  PDO($dsn, $user, $password);
					$stmt_tag_counter =$pdo_tag_counter->prepare("SELECT COUNT(tag) as count_tag FROM toeicengineer_db.link WHERE email =:email AND tag =:tag");
					$email=$_SESSION['email'];
					$tag = $row['tag'];
					$stmt_tag_counter->bindParam(":email", $email);
					$stmt_tag_counter->bindParam(":tag"  , $tag);
					$stmt_tag_counter->execute();
					$row_tag_counter=$stmt_tag_counter->fetch();
					echo '<li>';
					echo '		<a href="'.$page_selTag.'?tag='.$row['tag'].'" target="">'.$row['tag'].'('.$row_tag_counter['count_tag'].')</a>';
					echo '</li>';
				}
				echo '</ul>';
			}
			$pdo_tag_counter = null;
			$pdo_tag=null;
		 ?>

	</div>
	<div id="bookmarks" class="box">
		<h2 class="headline">ブックマーク</h2>
<?php
				//if (intVal($stmt_bookmark->rowCount()) == 0){
				if (intVal($count_bookmark) == 0){
echo <<< EOT
					<p>ブックマークがありません</p>
					<a href="{$page_bookmark}">ブックマーク登録</a>
EOT;
					
				}else{
/*
					echo '<ul>';
							while($row=$stmt_bookmark->fetch()){
echo <<< EOM
								<li>
									<a href="{$row['url']}" target="_blank"  name="{$row['name']}" >{$row['name']}</a>
									<a href="{$page_updUrl}&seq={$row['seq']}" target="_blank"  name="" >編集</a>
									<a href="{$page_delUrl}&seq={$row['seq']}" target="_blank"  name="" >削除</a>
								</li>
								
EOM;
							}
					echo '</ul>';
*/
					for ($i = 1 ; $i <= $totalPage ; $i++) : 
echo <<< EOT
					<a href="?page={$i}">{$i}</a>
EOT;
					endfor;
//					while($row=$stmt_bookmark->fetch()){
//
//echo <<< EOT
//					<div class="itemcontent">
//						<div class="iconBookmark"><a href="{$row['url']}" target="_blank"  name="{$row['name']}" ><img src="../img/icon_bookmark.png" width="16" height="16" alt"icon_bookmark"></a></div>
//						<div class="url"><a href="{$row['url']}" target="_blank"  name="{$row['name']}" >{$row['name']}</a></div>
//						<div class="edite"><a href="{$page_updUrl}&seq={$row['seq']}" target="_blank"  name="" >編集</a></div>
//						<div class="delete"><a href="{$page_delUrl}&seq={$row['seq']}" target="_blank"  name="" >削除</a></div>
//					</div>
//EOT;
//
//					}
//					
					foreach($bookmarks as $row){

echo <<< EOT
					<div class="itemcontent">
						<div class="iconBookmark"><a href="{$row['url']}" target="_blank"  name="{$row['name']}" ><img src="../img/icon_bookmark.png" width="16" height="16" alt"icon_bookmark"></a></div>
						<div class="url"><a href="{$row['url']}" target="_blank"  name="{$row['name']}" >{$row['name']}</a></div>
						<div class="edite"><a href="{$page_updUrl}&seq={$row['seq']}" target="_blank"  name="" >編集</a></div>
						<div class="delete"><a href="{$page_delUrl}&seq={$row['seq']}" target="_blank"  name="" >削除</a></div>
					</div>

EOT;

					}
				}
				$stmt_bookmark = null;
				$pdo_bookmark = null;
?>
	</div>
	<div id="footer">
	</div>
</div>
</body>
</html>