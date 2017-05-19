<html>
<head>
        <title>Sources</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="../navbarIframe.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
        <h1>Kyle Ross</h1>
        <h2>CSIS 311 Assignment 10</h2>
	<h3>Sources</h3>

        <iframe id="navbar" src="../navbar.html"></iframe>

	<form>
		<h4>Pick what you would like to see:</h4>
		<input type="submit" name="btn" value="View index.php">
		<input type="submit" name="btn" value="Questions">
		<input type="submit" name="btn" value="Current Results">
		<input type="submit" name="btn" value="Results">
	</form>

<?php

$btn = $_REQUEST["btn"];

if ($btn == "View index.php") {
	echo "<h4>index.php</h4>";
	highlight_file("index.php");
}

?>

        <footer>
                <a id="back" href=".">Back</a>
        </footer>
</body>
</html>
