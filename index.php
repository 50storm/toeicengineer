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
<meta name="viewport" content="width=device-width ">
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">
	google.load("jquery", "1.6.1");
</script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="./script/jquery.dataTables.js" type="text/javascript"></script>

<script>
	$(function() {
		$('#ToeicResume summary').tooltip({
			position:'top right'
		});
	   $('#ToeicScore').dataTable(
					{
						"aLengthMenu": [5, 10, 15,20,-1],
						"iDisplayLength": 20
					}
		)
	});
	
</script>
<link rel="stylesheet" href="./Css/Menu.css" type="text/css">
<link rel="stylesheet" href="./Css/Wrap.css" type="text/css">
<link rel="stylesheet" href="./Css/Index.css" type="text/css">
<link rel="stylesheet" href="./Css/demo_table.css" type="text/css">
<link rel="stylesheet" href="./Css/demo_page.css" type="text/css">
<!--
<link rel="stylesheet" href="./Css/demo_page.css" type="text/css">
<link rel="stylesheet" href="./Css/demo_table.css" type="text/css">
<link rel="stylesheet" href="./Css/jquery.dataTables.css" type="text/css">
<link rel="stylesheet" href="./Css/jquery.dataTables_themeroller.css" type="text/css">
<link rel="stylesheet" href="./Css/demo_table_iui.css" type="text/css">
-->

</head>
<body>
<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1&appId=389032904549748";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<div id="wrapper">
	<header>
		<div id="header">
		<?php include"header.html";?>
		</div>
	</header>
	<div id="menu" >
		<?php include"menu.html";?>
	</div>
	<div id="AboutMe" class="box" >
		<section>
			<h1>About Me</h1>
			<p>三人兄弟(姉一人、弟一人)の長男坊。商店の親のもとに生まれる。(1981年生まれ)。<br>成田とカナダとお酒をこよなく愛す。カナダで仕事を探しに、ワーキングホリデーで渡航。マクドナルドで就業。今は、まったりできる嫁さんを探し、日本と海外のデュアルライフを実現するのが夢。
			<br>趣味は、釣り、旅(バックパッカーで、ロッキー山脈。九州縦断(福岡～佐賀～熊本～屋久島にいきました)
			<br>仕事ではASP.NET HTML Css JavaScript SQLserver VB を利用。趣味で php　jQuery MySqlを触っています。
			</p>
		</section>
	</div>
	<figure id="Photo" class="box" >
		<?php include "photo.html"; ?>
	</figure>
	<div id="ToeicResume" class="box" >
	<!--
		<section>
			<h1 class="headline">TOEIC受験歴史</h1>
			<ul>
			<li>2008/05 　英会話のGEOSへ通いだす</li>
			<li>2008/06/29 495(L:285/R:210)</li>
			<li>2008/10/28 520(L:305/R:215)</li>
			<li>2009/07～2010/07 GEOS卒業し<b>Vancouver</b>へ</li>
			<li>2010/10/31 770(L:405/R:365)</li>
			<li>2010/11/28 820(L:415/R:405)</li>
			<li>2011/01/30 795(L:450/R:345)</li>
			<li>2011/05/29 825(L:445/R:380)<b>※800地獄に入る</b></li>
			<li>2011/11/27 825(L:430/R:395)</li>
			<li>2012/01/29 850(L:450/R:400)</li>
			<li>2012/03/18 865(L:445/R:420)</li>
			<li>2012/06/24 820(L:445/R:375)</li>
			<li>2012/07/22 900(L:490/R:410)※初の900!</li>
			<li>2012/09/23 865(L:445/R:410)</li>
			<li>2012/10/21 885(L:485/R:400)</li>
			<li>2012/11/18 950(L:495/R:455)<strong title="フォー！">※自己ベスト！(リスニング満点)</strong></li>
			<li>2013/03/17 890(L:450/R:440)</li>
			<li>2013/04/15 905(L:465/R:440)※900超え3回目!</li>
			</ul>
		</section>
	-->
	<h1 title="受験日　点数　リスニング　リーディングをクリックすると並べ替えできるよ" >TOEIC受験歴史</h1>
	<!--<details>
	<summary title="クリックで開くよ" >このテーブルの説明</summary>
	<p><strong>受験日　点数　リスニング　リーディング</strong>をクリックすると並べ替えできるよ</p>
	<p><strong>Search</strong>で検索できるよ</p>
	</details>-->
		<table  id="ToeicScore" class="display">
		<thead>
			<tr >
				<th >受験日</th>
				<th >点数</th>
				<th >リスニング</th>
				<th >リーディング</th>
				<th >一言</th>
			</tr>
		</thead>
		<tbody>
			<tr class="odd gradeA">
				<td class="center">2008/06/29</td>
				<td class="center">435</td>
				<td class="center">285</td>
				<td class="center">210</td>
				<td class="center"></td>
			</tr>
			<tr class="even gradeC">
				<td class="center">2008/10/28</td>
				<td class="center">520</td>
				<td class="center">305</td>
				<td class="center">215</td>
				<td class="center"></td>
			</tr>
			<tr class="odd gradeA">
				<td class="center">2010/10/31</td>
				<td class="center">770</td>
				<td class="center">405</td>
				<td class="center">365</td>
				<td class="center"></td>
			</tr>
			<tr class="even gradeC">
				<td class="center">2010/11/28</td>
				<td class="center">820</td>
				<td class="center">415</td>
				<td class="center">405</td>
				<td class="center"></td>
			</tr>
			<tr class="odd gradeA">
				<td class="center">2011/01/30</td>
				<td class="center">795</td>
				<td class="center">450</td>
				<td class="center">345</td>
				<td class="center"></td>
			</tr>
			<tr class="even gradeC">
				<td class="center">2011/05/29</td>
				<td class="center">825</td>
				<td class="center">445</td>
				<td class="center">380</td>
				<td class="center">※800地獄に入る</td>
			</tr>
			<tr class="odd gradeA">
				<td class="center">2011/11/27</td>
				<td class="center">825</td>
				<td class="center">430</td>
				<td class="center">395</td>
				<td class="center"></td>
			</tr>
			<tr class="even gradeC">
				<td class="center">2012/01/29</td>
				<td class="center">850</td>
				<td class="center">450</td>
				<td class="center">400</td>
				<td class="center"></td>
			</tr>
			<tr class="odd gradeA">
				<td class="center">2012/03/18</td>
				<td class="center">865</td>
				<td class="center">445</td>
				<td class="center">420</td>
				<td class="center"></td>
			</tr>
			<tr class="even gradeC">
				<td class="center">2012/06/24</td>
				<td class="center">820</td>
				<td class="center">445</td>
				<td class="center">375</td>
				<td class="center"></td>
			</tr>
			<tr class="odd gradeA">
				<td class="center">2012/07/22</td>
				<td class="center">900</td>
				<td class="center">490</td>
				<td class="center">410</td>
				<td class="center">※初の900!</td>
			</tr>
			<tr class="even gradeC">
				<td class="center">2012/09/23</td>
				<td class="center">865</td>
				<td class="center">445</td>
				<td class="center">410</td>
				<td class="center"></td>
			</tr>
			<tr class="odd gradeA">
				<td class="center">2012/10/21</td>
				<td class="center">885</td>
				<td class="center">485</td>
				<td class="center">400</td>
				<td class="center"></td>
			</tr>
			<tr class="even gradeX">
				<td class="center">2012/11/18</td>
				<td class="center">950</td>
				<td class="center">495</td>
				<td class="center">455</td>
				<td class="left">※自己ベスト！(リスニング満点)</td>
			</tr>
			<tr class="odd gradeA">
				<td class="center">2013/03/17</td>
				<td class="center">890</td>
				<td class="center">450</td>
				<td class="center">440</td>
				<td class="center"></td>
			</tr>
			<tr class="even gradeC">
				<td class="center">2013/04/15</td>
				<td class="center">905</td>
				<td class="center">465</td>
				<td class="center">440</td>
				<td class="center"></td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</tfoot>
		</table>
	</div>
	<div id="Ad">
		<script type="text/javascript"><!--
		google_ad_client = "ca-pub-8375436161547427";
		/* AdSakura */
		google_ad_slot = "7755548277";
		google_ad_width = 300;
		google_ad_height = 600;
		//-->
		</script>
		<script type="text/javascript"
		src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
		</script>
	</div>
	<footer>
		<!--<div style="clear:both;" > -->
			<?php include"footer.html"; ?>
		<!-- </div> -->
	</footer>
</div>
</body>
</html>