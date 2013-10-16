<?php
Class Utility{
	public static  function h($str){
		return htmlspecialchars($str, ENT_QUOTES);
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
		$uri   = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME']))).'/view' ;
		$Url   = "http://".$host.$uri."/".$file;
		return $Url;
	}
	
	
	public static function makeUrlController($file){
		$Url='';
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME']))).'/controller' ;
		$Url   = "http://".$host.$uri."/".$file;
		return $Url;
	}

}