<?php

/**
 * Utility Class
 * * */
class Util
{
	/*
	 * Make Link
	 * @param $url URL
	 * @param $name –¼‘O
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
		//jQuery‚Ì•\Ž¦—p
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
}
?>