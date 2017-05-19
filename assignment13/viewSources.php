<html>
<head>
        <title>Sources</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="../navbarIframe.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
        <h1>Kyle Ross</h1>
        <h2>CSIS 311 Assignment 12</h2>
	<h3>Sources</h3>

        <iframe id="navbar" src="../navbar.html"></iframe>

	<form>
		<h4>Pick what you would like to see:</h4>
		<?php outputFileButtons(); ?>
		<input type="submit" name="btn" value="Clear">
	</form>

<?php

$btn = $_REQUEST["btn"];

if ($btn != NULL && $btn != "Clear") {
	echo "<h4>View $btn</h4>";
	highlight_file($btn);
}

?>

        <footer>
                <a id="back" href=".">Back</a>
        </footer>
</body>
</html>

<?php

function listFiles($directory) {
	$files = scandir($directory);
	array_splice($files, 0, 2);//this removes the entries for "." and ".."
	return $files;
}

function outputFileButtons() {
	$files = listFiles(".");

	foreach ($files as $file)
		echo "<input type='submit' name='btn' value='$file'>\n";
}
?>
