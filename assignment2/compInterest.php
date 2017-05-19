<html>
<head>
	<title>Calculate Compound Interest</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="../navbarIframe.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
	<h1>Kyle Ross</h1>
	<h2>CSIS 311 Assignment 2</h2>
	<h3>Calculate Compound Interest</h3>

	<iframe id="navbar" src="../navbar.html" scrolling="no" frameborder="0" border="0"></iframe>

<?php
$principle = $_REQUEST["principle"];
$interest = $_REQUEST["interest"];
$n = $_REQUEST["n"];
$years = $_REQUEST["years"];

$interest = $interest / 100;
$amount = $principle * pow((1 + ($interest / $n)), ($n * $years));
$amount = number_format($amount, 2);

$interest = $interest * 100;

echo "<p>";
echo "<b>$$principle</b> with a <b>$interest%</b> interest rate compounded ";
echo "<b>$n</b> times in <b>$years</b> years is <b>$amount</b>";
echo "</p>";
?>

<footer>
	<br />
	<p><a href="compInterest.html">Back</a></p>
	<br />

<?php
echo "<HR>";
highlight_file("compInterest.php");
?>

</footer>
</body>
</html>
