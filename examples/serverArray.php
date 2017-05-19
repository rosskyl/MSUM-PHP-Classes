<?php 
echo "<h1>_SERVER</h1>";
foreach ($_SERVER as $item => $value)
	if ($item <> "PHP_AUTH_PW")
		echo "<p>$item: $value<p>";
?>
