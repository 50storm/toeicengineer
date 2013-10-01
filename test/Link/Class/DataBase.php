<?php
Class DataBase{
	private $dsn  ;
	private $user ;
	private $password ;	
/*
	private $dsn = 'mysql:dbname=toeicengineer_db;host=localhost';
	private $user = 'toeicengineer';
	private $password = 'abc';
*/
	//$dsn = 'mysql:dbname=toeicengineer_db;host=mysql464.db.sakura.ne.jp';
	//$user = 'toeicengineer';
	//$password = 'hiro1128';
	
	function setDSN($dsn,$user,$password){
		$dsn=$dsn;
		$user=$user;
		$password=$password;
	}
	
	function initialize(){
		$pdo = new PDO($dsn, $user, $password);
		$pdo->query('SET NAMES UTF8');
		return $pdo;
	}
	
}

