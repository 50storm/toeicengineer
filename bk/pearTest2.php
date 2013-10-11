<?php
require_once 'Calendar/Month/Weekdays.php';
$calMonth = new Calendar_Month_Weekdays(2006, 8, 0);
$calMonth->build();
echo <<<EOD
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>
</head>
<body>
<table><thead><tr>
<th>åé</th><th>âŒ</th><th>êÖ</th><th>ñÿ</th><th>ã‡</th><th>ìy</th>
</th><th>ì˙</th>
</tr></thead><tbody>

EOD;
while ($day = $calMonth->fetch()) {
    if ($day->isFirst()) {
        echo '<tr>';
    }
    if ($day->isEmpty()) {
        echo '<td>&nbsp;</td>';
    } else {
        echo '<td>'.$day->thisDay().'</td>';
    }
    if ($day->isLast()) {
        echo '</tr>';
    }
}
echo <<<EOD
</tbody></table>
</body>
</html>
EOD;
?>