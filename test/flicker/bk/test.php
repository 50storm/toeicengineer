<!DOCTYPE HTML>
<html>
<head>
<title>FlickerAPI JSONサンプル</title>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script>
  $(function(){
    $.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?tags=toeic&tagmode=any&format=json&jsoncallback=?",
        function(data){
          $.each(data.items, function(i,item){
            $("<img/>").attr("src", item.media.m).appendTo("#images");
            	if ( i == 3 ) return false;
          });
        });
  });

  /*
  $(document).ready(function(){
  	$.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?user_id=56338954%40N07&format=json&nojsoncallback=?",
  	        function(data){
       			 $.each(data.items, function(i,item){
         			 $("<img/>").attr("src", item.media.m).appendTo("#images");
          				if ( i == 3 ) return false;
        	});
  });
	*/		  
  </script>
  <style>img{ height: 100px; float: left; }</style>
</head>
<body>
<div id="images">
</div>
</body>
</html>