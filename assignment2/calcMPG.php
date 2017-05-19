<html>
<head>
	<title>Calc MPG</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="../navbarIframe.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
	<h1>Kyle Ross</h1>
	<h2>CSIS 311 Assignment 2</h2>
	<h3>Calculate Miles per Gallon</h3>

	<iframe id="navbar" src="../navbar.html" scrolling="no" frameborder="0" border="0"></iframe>

<?php
$miles = $_REQUEST["miles"];
$gallons = $_REQUEST["gallons"];

$mpg = $miles / $gallons;
$mpg = number_format($mpg, 2);
echo "<p>";
echo "<b>$miles</b> miles travelled with <b>$gallons</b> gallons used is <b>$mpg</b> miles per gallon";
echo "</p>";
?>

<footer>
	<br />
	<p><a href="calcMPG.html">Back</a></p>
	<br />
<?php
echo "<HR>";
highlight_file("calcMPG.php");
?>
</footer>
</body>
</html>
