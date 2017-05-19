<?php

$x = array(1,2,3,4,5);

reset($x);
$ptr = current($x);


while (current($x)) {
	$ptr += 1;
	echo "$ptr ";
	$ptr = next($x);
}

print_r($x);

?>
