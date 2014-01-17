<?php
Class Utility{

	public static  function h($str){
		return htmlspecialchars($str, ENT_QUOTES,'UTF-8');
	}
	
	public static function is_mail($text) {
		if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $text)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public static function makeUrlModel($file){
		$Url='';
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME']))).'/model' ;
		$Url   = "http://".$host.$uri."/".$file;
		return $Url;
	}
	
	public static function makeUrlView($file){
		$Url='';
		$host  = $_SERVER['HTTP_HOST'];
		//$uri   = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME']))).'/view' ;
		//$uri   = rtrim(dirname($_SERVER['SCRIPT_NAME'])).'/view' ;
		$uri   = rtrim(dirname($_SERVER['SCRIPT_NAME'])).'' ;
		//localhostとsakuraサーバーで違う
		if ($_SERVER['HTTP_HOST'] == 'localhost'){
			$Url   = "http://".$host.$uri.DIRECTORY_SEPARATOR.$file;
		}else{
			$Url   = "http://".$host.$uri.$file;
		}
		return $Url;
	}
	
	public static function makeLinkUrl($file){
		$Url='';
		$host  = $_SERVER['HTTP_HOST'];
		//$uri   = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME']))).'/view' ;
		//$uri   = rtrim(dirname($_SERVER['SCRIPT_NAME'])).'/view' ;
		$uri   = rtrim(dirname(dirname(dirname($_SERVER['SCRIPT_NAME'])))).'' ;
		//localhostとsakuraサーバーで違う
		if ($_SERVER['HTTP_HOST'] == 'localhost'){
			$Url   = "http://".$host.$uri.DIRECTORY_SEPARATOR.$file;
		}else{
			$Url   = "http://".$host.$uri.$file;
		}
		return $Url;
		//echo "URLテスット";
		//var_dump($Url);
		//exit;
	}

	
	public static function makeUrlController($file){
		$Url='';
		$host  = $_SERVER['HTTP_HOST'];
		//$uri   = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME']))).'/controller' ;
		$uri   = rtrim(dirname($_SERVER['SCRIPT_NAME'])).DIRECTORY_SEPARATOR.'link'.DIRECTORY_SEPARATOR.'controller' ;
		if ($_SERVER['HTTP_HOST'] == 'localhost'){
			$Url   = "http://".$host.$uri.DIRECTORY_SEPARATOR.$file;
		}else{
			$Url   = "http://".$host.$uri.$file;
		}
		$Url   = "http://".$host.$uri.DIRECTORY_SEPARATOR.$file;
		return $Url;
	}

}