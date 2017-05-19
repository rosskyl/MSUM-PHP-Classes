<?php

$date = mktime(0, 0, 0, 2, 7, date("Y"));
$today = getdate();

$days = floor(($date-$today[0])/86400)+1;

echo $days;

echo "\n";

echo $days + 365;

echo "\n";

print_r($today);

echo "\n";

$date = mktime(0,0,0,2,29,2017);
echo date("l", $date);

echo "\n";
?>
