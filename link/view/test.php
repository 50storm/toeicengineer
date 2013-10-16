<?php
session_start();
var_dump($GLOBALS);
var_dump($_SERVER);
var_dump($_SERVER['PHP_SELF']);
var_dump($_SERVER['SCRIPT_NAME']);

var_dump( $_COOKIE );

var_dump( $_SESSION );
var_dump( $_ENV );
//var_dump($HTTP_RAW_POST_DATA);

$new = htmlspecialchars("<a href='test'>Test</a>", ENT_QUOTES);
echo $new ;
$new = htmlspecialchars("<a href='test'>Test</a>");
echo $new ;
//$new = "<a href='test'>Test</a>";
//echo $new ;
$new = htmlspecialchars("<script>alert('test');</script>");
echo $new ;
