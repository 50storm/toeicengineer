<?php
require('Util.php');
$objUtil = new Util();
$ret=$objUtil->MakeLink(
		'http://php.net/manual/ja/language.oop5.basic.php',
		'phpmanual',
		'1',
		'ooooo'
);
echo $ret;
sleep(10);