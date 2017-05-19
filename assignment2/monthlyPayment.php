<html>
<head>
	<title>Calc Monthly Payment</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="../navbarIframe.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
	<h1>Kyle Ross</h1>
	<h2>CSIS 311 Assignment 2</h2>
	<h3>Calculate Monthly Payment</h3>

	<iframe id="navbar" src="../navbar.html" scrolling="no" frameborder="0" border="0"></iframe>

<?php
$val = $_REQUEST["val"];
$r = $_REQUEST["r"];
$n = $_REQUEST["n"];

$r = $r / 100;
$amount = ($r * $val) / (1 - pow(1+$r, -$n));
$amount = number_format($amount, 2);

$r = $r * 100;

echo "<p>";
echo "The monthly payment to pay <b>$$val</b> off over <b>$n</b> ";
echo "months with an interest rate of <b>$r%</b> is <b>$$amount</b>";
echo "</p>";
?>

<footer>
	<br />
	<p><a href="monthlyPayment.html">Back</a></p>
	</br>

<?php
echo "<HR>";
highlight_file("monthlyPayment.html");
?>
</footer>
</body>
</html>
