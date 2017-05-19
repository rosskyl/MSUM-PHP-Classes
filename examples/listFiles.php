<?php
$dir = ".";
$dh  = opendir($dir);
while (false !== ($filename = readdir($dh))) {
    $files[] = $filename;
}

sort($files);

print_r($files);

rsort($files);

print_r($files);


echo "<br>------------------------------<br>";

$files1 = scandir($dir);
$files2 = scandir($dir, 1);

print_r($files1);
print_r($files2);



?>
