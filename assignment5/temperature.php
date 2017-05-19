<html>
<head>
	<title>Convert Temps</title>
	<link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="../navbarIframe.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
        <h1>Kyle Ross</h1>
        <h2>CSIS 311 Assignment 5</h2>
        <h3>Convert Temperatures</h3>

        <iframe id="navbar" src="../navbar.html" scrolling="no" frameborder="0" border="0"></iframe>

	<form action="temperature.php">

<?php
if (isset($_REQUEST["temp"]) && $_REQUEST["submit"] != "Clear")
	$temp = $_REQUEST["temp"];
else
	$temp = "";
echo <<< HERE
	<fieldset>
		<h4>Temperature<input type="text" name="temp" value="$temp" autocomplete="off"></h4>
		<input type="submit" name="submit" value="Fahrenheit to Celsius">
		<input type="submit" name="submit" value="Celsius to Fahrenheit">
		<input type="submit" name="submit" value="Clear">
	</fieldset>
HERE;
if (isset($_REQUEST["submit"])) {
	if ($_REQUEST["submit"] == "Fahrenheit to Celsius") {
		$original = "Fahrenheit";
		$new = "Celsius";
		$newTemp = fToC($temp);
		echo "<b>$temp</b> degrees $original is <b>$newTemp</b> degrees $new";
	}
	elseif ($_REQUEST["submit"] == "Celsius to Fahrenheit") {
		$original = "Celsius";
		$new = "Fahrenheit";
		$newTemp = cToF($temp);
		echo "<b>$temp</b> degrees $original is <b>$newTemp</b> degrees $new";
	}
}

function fToC($temp) {
	return number_format(($temp - 32) * (5/9), 2);
}

function cToF($temp) {
	return number_format(($temp * (9/5)) + 32, 2);
}
?>
	</form>
	<footer>
		<form action="viewTemperature.php">
			<a id = "back" href=".">Back</a>
			<input id="back" type="submit" value="View Source">
		</form>
	</footer>
</body>
</html>
