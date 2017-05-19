<html>
<head>
	<title>Convert Temps</title>
	<link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="../navbarIframe.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
        <h1>Kyle Ross</h1>
        <h2>CSIS 311 Assignment 3</h2>
        <h3>Convert Temperatures</h3>

        <iframe id="navbar" src="../navbar.html" scrolling="no" frameborder="0" border="0"></iframe>

<?php
$temp = $_REQUEST["temp"];
$cToF = $_REQUEST["cToF"];
$fToC = $_REQUEST["fToC"];

if ($fToC == "Fahrenheit to Celsius") {
	$original = "Fahrenheit";
	$new = "Celsius";
	$newTemp = ($temp - 32) * (5/9);
}
else {
	$original = "Celsius";
	$new = "Fahrenheit";
	$newTemp = ($temp * (9/5)) + 32;
}

echo "<p>";
echo "<b>$temp</b> degrees $original is <b>$newTemp</b> degrees $new";
echo "</p>";
?>

	<footer>
		<p><a id = "back" href="convertTemp.html">Back</a></p>
		<br />
<?php
echo "<HR>";
highlight_file("convertTemp.php");
?>

	</footer>
</body>
</html>
