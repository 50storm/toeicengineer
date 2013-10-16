<?php
/**
 * Utility Class
 * * */
class Util
{
	/*
	 * Make Link
	 * @param $url URL
	 * @param $name ���O
	 * @param $target 
	 * @param $title
	 * */
	public function MakeLink($url,$name,$target,$title)
	{
		$ancher='<a href="';
		$ancher.=$url;
		$ancher.='"';
		
		
		if($target == "0"){
			$ancher.=' target=""' ;
		}else{
			$ancher.=' target="_blank"' ;
		}
		
		if($title ==""){
		}else{
			$ancher.=' title="';
			$ancher.=$title;
			$ancher.='" ';
			
		}
		$ancher.='>';
		$ancher.=$name;
		$ancher.=" </a>";
		return $ancher;
	}
	/*
	public function MakeLink($url,$name)
	{
		$ancher='<a href="';
		$ancher.=$url;
		$ancher.='"';
		$ancher.='>';
		$ancher.=$name;
		$ancher.=" </a>";
		return $ancher;
	}
	*/
	/*
	 * is_mail
	 *@param $emailadd E-mail address
	 **/
	public function is_mail($emailadd) {
		if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $emailadd)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	/*
	 * get_mode
	*@param $file filename
	**/
	public function get_mode($file){
		$mode="";
		
		$fp = fopen($file, 'r');
		$line = fgets($fp);
		$wk_line=explode(":",$line);
		$mode =	$wk_line[1];
		fclose($fp);
		return $mode;		
	}
	
	public function get_dsn($file){
		$dsn = array('dsn' => ''  ,
					 'user' => '' ,
					 'password' => ''
					 );

		$fp = fopen($file, 'r');
		while(!feof($fp)) {
			$line = fgets($fp);
			$wk_line=explode("==",$line);
			switch ($wk_line[0]){
				case "dsn";
					$dsn["dsn"] = $wk_line[1];
					break;

				case "user";
					$dsn["user"] = $wk_line[1];
					break;
					
				case "password";
					$dsn["password"] = $wk_line[1];
					break;
			}

		}
		fclose($fp);
		return $dsn;
	}
}
?>