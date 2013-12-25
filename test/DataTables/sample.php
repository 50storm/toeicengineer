<!DOCTYPE HTML>
<html>
<head>
<title>FlickerAPI JSONサンプル</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" href="../../Css/Menu.css" type="text/css">
<link rel="stylesheet" href="../../Css/Wrap.css" type="text/css">
<link rel="stylesheet" href="../../Css/Index.css" type="text/css">
<link rel="stylesheet" href="../../Css/demo_table.css" type="text/css">
<link rel="stylesheet" href="../../Css/demo_page.css" type="text/css">
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script src="../../script/jquery.dataTables.js" type="text/javascript"></script>
  <script>
  $(document).ready(function() {
		$('#example').dataTable( {
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "./server_processing.php"
		} );
	} );
  </script>
  <style>img{ height: 100px; float: left; }</style>
</head>
<body>

<table id="example">
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
    
    </tbody>
</table>


</body>
</html>