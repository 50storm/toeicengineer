<?php
//
//http://codezine.jp/article/detail/433?p=2
//http://www.php-labo.net/tutorial/class/pdo.html
require_once('./Class/Utility.php');
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

	$(function() {
	   $('#linkTable').dataTable(
					{
						"aLengthMenu": [5, 10, 15,20,-1],
						"iDisplayLength": 30
					}
		)
	});


</script>
<link rel="stylesheet" href="Css/Menu.css" type="text/css">
<link rel="stylesheet" href="Css/Wrap.css" type="text/css">
<link rel="stylesheet" href="Css/Link.css" type="text/css">

<link rel="stylesheet" href="./Css/demo_table.css" type="text/css">
<link rel="stylesheet" href="./Css/demo_page.css" type="text/css">
</head>
<body>
<div id="wrapper">
	<div id="header">
	
		<?php include"header.html"; ?>
			
	</div>
	<div id="menu" >
	
		<?php include"menu.html";  ?>
	
	</div>
	<div id="leftSpace">
		<p></p>
	</div>
	<div id="link">
		<table id="linkTable">
			<caption>Bookmarks</caption>
			<thead>
				<th>カテゴリー</th>
				<th>リンク</th>
			</thead>
			<tbody>
			<tr>
				<td>News</td>
				<td><a href="http://www3.nhk.or.jp/nhkworld/" target="_blank" title="NHKニュース！">NHKWORLD (ENGLISH)</a></td>
			</tr>
			<tr>
				<td>News</td>
				<td><a href="http://edition.cnn.com/video/" target="_blank" title="CNNニュース！">CNN VIDEO</a></td>
			</tr>
			<tr>
				<td>News</td>
				<td><a href="http://bizmakoto.jp/bizid/" target="_blank" title="誠">誠</a></td>
			</tr>
			<tr>
				<td>News</td>
				<td><a href="http://www.yomiuri.co.jp/" target="_blank" title="読売">読売オンライン</a></td>
			</tr>
			<tr>
				<td>News</td>
				<td><a href="http://www.nikkei.com/" target="_blank" title="日系">日経新聞</a></td>
			</tr>
			<tr>
				<td>検索サイト</td>
				<td><a href="http://www.google.co.jp/webhp?rls=ig" target="_blank">Google</a></td>
			</tr>
			<tr>
				<td>検索サイト</td>
				<td><a href="http://www.yahoo.co.jp/" target="_blank">Yahoo Japan</a></td>
			</tr>
			<tr>
				<td>検索サイト</td>
				<td><a href="http://jp.msn.com/" target="_blank">Msn Japan</a></td>
			</tr>
			<tr>
				<td>検索サイト</td>
				<td><a href="http://www.livedoor.com/" target="_blank">Livedoor</a></td>
			</tr>
			<tr>
				<td>検索サイト</td>
				<td><a href="http://www.goo.ne.jp/" target="_blank">goo</a></td>
			</tr>
			<tr>
				<td>検索サイト</td>
				<td><a href="http://www.naver.jp/" target="_blank">NAVER</a></td>
			</tr>
			<tr>
				<td>English news</td>
				<td><a href="http://metronews.ca/" target="_blank">MetroNews</a></td>
			</tr>
			<tr>
				<td>English news</td>
				<td><a href="http://ca.yahoo.com/" target="_blank">Yahoo Canada</a></td>
			</tr>
			<tr>
				<td>English news</td>
				<td><a href="http://ca.msn.com/" target="_blank">Msn Canada</a></td>
			</tr>
			<tr>
				<td>English news</td>
				<td><a href="http://www.wired.com/" target="_blank">wired.com</a></td>
			</tr>
			<tr>
				<td>English news</td>
				<td><a href="http://www.interviewmagazine.com/#music" target="_blank" >interview magagine</a></td>
			</tr>			
			<tr>
				<td>English news</td>
				<td><a href="http://ca.omg.yahoo.com/" target="_blank" >omg!</a></td>
			</tr>
			<tr>
				<td>English news</td>
				<td><a href="http://www.alc.co.jp/eng/newsbiz/headline/" target="_blank" >やさしい英語でニュースを読む</a></td>
			</tr>
			<tr>
				<td>SNS sites</td>
				<td><a href="https://www.facebook.com/hiroshibook" target="_blank">FaceBook</a></td>
			</tr>
			<tr>
				<td>SNS sites</td>
				<td><a href="http://twitter.com/" target="_blank">Titter</a></td>
			</tr>
		
			<tr>
				<td>SNS sites</td>
				<td><a href="http://mixi.jp/" target="_blank">mixi</a></td>
			</tr>
		
			<tr>
				<td>SNS sites</td>
				<td><a id="Lang8" href="http://lang-8.com/" target="_blank">Lang8</a></td>
			</tr>
		
			<tr>
				<td>SNS sites</td>
				<td><a href="http://www.ameba.jp/" target="_blank">ameba</a></td>
			</tr>
		
			<tr>
				<td>SNS sites</td>
				<td><a href="http://www.nicovideo.jp/" target="_blank">にこにこ動画</a></td>
			</tr>
		
			<tr>
				<td>SNS sites</td>
				<td><a href="http://www.flickr.com/" target="_blank">flicker</a></td>
			</tr>
			<tr>
				<td>ITトレンド</td>
				<td><a href="http://www.atmarkit.co.jp/" target="_blank">@IT</a></td>
			</tr>
			<tr>
				<td>ITトレンド</td>
				<td><a href="http://itpro.nikkeibp.co.jp/" target="_blank">IT Pro</a></td>
			</tr>
			<tr>
				<td>ITトレンド</td>
				<td><a href="http://engineer.typemag.jp/" target="_blank">エンジニアType</a></td>
			</tr>
			<tr>
				<td>ITトレンド</td>
				<td><a href="http://it-trend.jp/" target="_blank">ITトレンド</a></td>
			</tr>
			<tr>
				<td>English</td>
				<td><a href="http://www.alc.co.jp/index.html" target="_blank">英次郎</a></td>
			</tr>
			<tr>
				<td>English</td>
				<td><a href="http://endic.naver.jp/" target="_blank">Naver辞書</a></td>
			</tr>
			<tr>
				<td>English</td>
				<td><a href="http://dictionary.goo.ne.jp/" target="_blank">goo辞書</a></td>
			</tr>
			<tr>
				<td>English</td>
				<td><a href="http://toeickateikyousi.mitsu-hide.com/" target="_blank">スーパー英語家庭教師</a></td>
			</tr>
			<tr>
				<td>English</td>
				<td><a href="https://www.worldtalk.jp/" target="_blank">ワールドトーク</a></td>
			</tr>
			<tr>
				<td>オンラインモール</td>
				<td><a href="http://www.amazon.co.jp/">amazon.co.jp</a></td>
			</tr>
			<tr>
				<td>オンラインモール</td>
				<td><a href="http://www.rakuten.co.jp/" target="_blank">楽天</a></td>
			</tr>
			<tr>
				<td>オンラインモール</td>
				<td><a href="http://shopping.yahoo.co.jp/" target="_blank">Yahoo ショッピング</a></td>
			</tr>
			<tr>
				<td>オンラインモール</td>
				<td><a href="http://www.dena-ec.com/" target="_blank">Dena Shopping</a></td>
			</tr>
			<tr>
				<td>オンラインモール</td>
				<td><a href="http://www.aeonshop.com/index.html" target="_blank">イオン　ショップ</a></td>
			</tr>
			<tr>
				<td>メール</td>
				<td><a href="http://www.freeml.com/" target="_blank">Freeml</a></td>
			</tr>
			<tr>
				<td>メール</td>
				<td><a href="http://www.mail.com/int/" target="_blank">mail.com</a></td>
			</tr>
		
			<tr>
				<td>メール</td>
				<td><a href="https://gmail.google.com/" target="_blank">Gmail</a></td>
			</tr>
			<tr>
				<td>フリーソフト</td>
				<td><a href="http://ja.poderosa.org/index.html">Poderosa(ポデローサ)</a></td>
			</tr>
			<tr>
				<td>フリーソフト</td>
				<td><a href="http://www.forest.impress.co.jp/library/software/cajamarcaeye/download_10807.html">カハマルカの瞳(簡易キャプチャレコーダー)</a></td>
			</tr>
			<tr>
				<td>フリーソフト</td>
				<td><a href="http://freesoft-100.com/" target="_blank">フリーソフト 100</a></td>	
			</tr>
			<tr>
				<td>フリーソフト</td>
				<td><a href="http://notepad-plus-plus.org/" target="_blank">Notepad++本家サイト</a></td>
			</tr>
			<tr>
				<td>フリーソフト</td>
				<td><a href="http://www.crystal-creation.com/software/technical-information/tool/editor/notepad-plus/" target="_blank">Notepad++の使用方法</a></td>
			</tr>
			<tr>
				<td>まとめ</td>
				<td><a href="http://まとめ.naver.jp/odai/2131600405413155201" target="_blank">英英辞典まとめ</a></td>
			</tr>
			<tr>
				<td>まとめ</td>
				<td><a href="http://まとめ.naver.jp/odai/2131471255391732701" target="_blank" >システム開発にお役立ちフリーソフトまとめてみました</a></td>
			</tr>
			<tr>
				<td>まとめ</td>
				<td><a href="http://まとめ.naver.jp/odai/2131556784006652701" target="_blank" >英語の資格まとめてみました。</a></td>
			</tr>
			<tr>
				<td>プログラミング</td>
				<td><a href="http://www.openspc2.org/reibun/JavaScript_technique/" target="_blank" >JavaScript テクニックブック</a></td>
			</tr>
			<tr>
				<td>プログラミング</td>
				<td><a href="http://coffeescript.org/" target="_blank" >CoffeeScript本家</a></td>
			</tr>
			<tr>
				<td>プログラミング</td>			
				<td><a href="http://itpro.nikkeibp.co.jp/article/COLUMN/20120620/404226/" target="_blank" >CoffeeScriptって何？</a></td>
			</tr>
			<tr>
				<td>プログラミング</td>
				<td><a href="http://phpmentors.jp/" target="_blank" >php メンターズ</a></td>
			</tr>
			<tr>
				<td>プログラミング</td>
				<td><a href="http://homepagelecture.web.fc2.com/" target="_blank" >いまさらHTML,CSS入門講座</a></td>
			</tr>
			<tr>
				<td>プログラミング</td>
				<td><a href="http://hprakuraku.web.fc2.com/" target="_blank" >ホームページの作り方</a></td>
			</tr>
			<tr>
				<td>プログラミング</td>
				<td><a href="http://まとめ.naver.jp/odai/2130882659276553201" target="_blank" >コマンドライン操作まとめ</a></td>
			</tr>
			<tr>
				<td>プログラミング</td>
				<td><a href="http://ascii.jp/elem/000/000/438/438206/" target="_blank" >jQuery UI サンプル</a></td>
			</tr>
			<tr>
				<td>プログラミング</td>
				<td><a href="http://まとめ.naver.jp/odai/2132851038557722801" target="_blank" >jQueryでTable</a></td>
			</tr>
			<tr>
				<td>SEO</td>
				<td><a href="http://www.seotools.jp/" target="_blank" >SEO TOOLS</a></td>
			</tr>
			<tr>
				<td>SEO</td>
				<td><a href="http://seocheki.net/" target="_blank" >SEOチェキ</a></td>
			</tr>
			<tr>
				<td></td>
				<td><a href="http://iga1128.wix.com/toeicengineer" target="_blank">WIXでHTML５ホームページを楽々作成</a></td>
			</tr>
			<tr>
				<td>自作プログラム</td>
				<td><a href="./prg/mailForm.html" target="_blank" >メールメモ</a></td>
			</tr>
			<tr>
				<td></td>
				<td><a href="http://まとめ.naver.jp/odai/2133595365976855601" target="_blank" >TOEICer Blogs!</a></td>
			</tr>
			<tr>
				<td></td>
				<td><a href="https://www.facebook.com/groups/479377392081229/" target="_blank" >新宿コミュニケーションクラブ</a></td>
			</tr>
			<tr>
				<td>ツール</td>
				<td><a href="http://chosuke.rumix.jp/" target="_blank">ちょー助</a></td>
			</tr>
			<tr>
				<td></td>
				<td><a href="http://www.lancers.jp/" target="_blank">Lancers</a></td>
			</tr>
			<tr>
				<td>ツール</td>
				<td><a href="https://www.datadeliver.net/" target="_blank">データ便</a></td>
			</tr>
			<tr>
				<td></td>
				<td><a href="http://weblearningplaza.jst.go.jp/" target="_blank">Ｗｅｂラーニングプラザ</a></td>
			</tr>
			<tr>
				<td></td>
				<td><a href="http://dotinstall.com/" target="_blank">どっといんすとーる</a></td>
			</tr>
			<tr>
				<td></td>
				<td><a href="http://store.jp/" target="_blank" >Store.jp</a></td>
			</tr>
			<tr>
				<td></td>
				<td><a href="http://zerostore.jp/" target="_blank" >zero store</a></td>
			</tr>
			<tr>
				<td></td>
				<td><a href="https://thebase.in/" target="_blank" >thebase</a></td>
			</tr>
			<tr>
				<td></td>
				<td><a href="http://www.gmt.ne.jp/onlineshop/" target="_blank" >ゼロ　ショップ</a></td>
			</tr>
			<tr>
				<td></td>
				<td><a href="http://liginc.co.jp/" target="_blank" >LIG</a></td>
			</tr>
			<tr>
				<td>検索サイト</td>
				<td><a href="http://jp.hao123.com/?tn=sft_hp_hao123_jp" target="_blank" >Hao123</a></td>
			</tr>
			<tr>
				<td>ツール</td>
				<td><a href="https://live.cybozu.co.jp/" target="_blank">サイボウズLive</a></td>
			</tr>
			<tr>
				<td></td>
				<td><a href="http://www.lifehacker.com/">Lifehacker</a></td>
			</tr>
			<tr>
				<td></td>
				<td><a href="http://www.lifehacker.jp/">Lifehacker[日本語版]</a></td>
			</tr>
			<tr>
				<td>ツール</td>
				<td><a href="http://www.teglet.co.jp/">TEGLET</a></td>
			</tr>
			</tbody>
		</table>
	</div>
	<div id="rightSpace">
		<p></p>
	</div>

	<!--
	<div id="hiroshiTowa" class="box">
			<table id="HiroshimaTable" border="1" >
			<tr>
				<td align="center">
					<a  id="labelHiroshiTowa"  href="JavaScript:loadText(0);">Hiroshi,ma!???</a>
				</td>
			</tr>
			<tr>
				<td class="center">
					<div id="hiroshiTowaHonbun">リンクをクリックするとHiroshi,ma!?の生態が表示されます</div>
				</td>
			</tr>
			</table>
	</div>
	-->
	
	
		<!--
		<div>
			<iframe src="https://www.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffff00&amp;src=iga1128%40gmail.com&amp;color=%23A32929&amp;ctz=Asia%2FTokyo" style=" border-width:0 " width="800" height="600" frameborder="0" scrolling="no"></iframe>
		</div>
		-->
	<!--
	<hr>
	<form action="http://www.google.co.jp/search" method="get">
	<input type="hidden" name="as_epq" value="siriasu">
	<input type="hidden" name="as_occt" value="any">
	<input type="hidden" name="as_sitesearch" value="hirohiroigaiga.zxq.net/">
	<input type="hidden" name="num" value="10">
	サイト内検索
	<input type="text" size="20" name="as_q">
	<input type="submit" name="btnG" value="検索">
	Powered by <a href="http://www.google.co.jp/">Google</a>
	</form>
	-->
	<div id="footer">
		<?php include"footer.html"; ?>
	</div>
</div>
</body>
</html>