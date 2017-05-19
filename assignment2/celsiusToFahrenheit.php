<html>
<head>
	<title>Celsius to Fahrenheit</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="../navbarIframe.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
	<h1>Kyle Ross</h1>
	<h2>CSIS 311 Assignment 2</h2>
	<h3>Convert Celsius to Fahrenheit</h3>

	<iframe id="navbar" src="../navbar.html" scrolling="no" frameborder="0" border="0"></iframe>

<?php
$cels = $_REQUEST["cels"];
$fahr = ($cels * (9/5)) + 32;
//$fahr = number_format($fahr, 2);
echo "<p>";
echo "<b>$cels</b> degrees Celsius is <b>$fahr</b> degrees Fahrenheit";
echo "</p>";
?>

</body>
<footer>
	<br />
	<p><a href="celsiusToFahrenheit.html">Back</a></p>
	<br />
<?php
echo "<HR>";
highlight_file("celsiusToFahrenheit.php");
?>

</footer>
</body>
</html>
