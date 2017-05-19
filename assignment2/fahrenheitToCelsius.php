<html>
<head>
	<title>Fahrenheit to Celsius</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="../navbarIframe.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<h1>Kyle Ross</h1>
<h2>CSIS 311 Assignment 2</h2>
<h3>Fahrenheit to Celsius</h3>
<iframe id="navbar" src="../navbar.html" scrolling="no" frameborder="0" border="0"></iframe>

<?php
$fahr = $_REQUEST['fahr'];
$cels = ($fahr - 32) * (5/9);
//$cels = number_format($cels, 2);
echo "<p>";
echo "<b>$fahr</b> degrees Fahrenheit is <b>$cels</b> degrees Celsius";
echo "</p>";
?>

</body>
<footer>

<br />
<p><a href="fahrenheitToCelsius.html">Back</a></p>
<br />

<?php
echo "<HR>";
highlight_file("fahrenheitToCelsius.php");
?>

</footer>
</body>
</html>
