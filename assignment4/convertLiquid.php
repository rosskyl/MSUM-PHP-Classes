<html>
<head>
        <title>Convert Liquid</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="../navbarIframe.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php

function gallonsLiters($amt) {
	return number_format($amt / 0.26417, 2);
}

function litersGallons($amt) {
	return number_format($amt * 0.26417, 2);
}

?>

</head>
<body>
        <h1>Kyle Ross</h1>
        <h2>CSIS 311 Assignment 4</h2>
        <h3>Convert Liquid</h3>

        <iframe id="navbar" src="../navbar.html" scrolling="no" frameborder="0" border="0"></iframe>

<?php
$amt = $_REQUEST["amt"];
$button = $_REQUEST["submit"];

if ($button == "Gallons to Liters") {
	$original = "gallons";
	$new = "liters";
	$newAmt = gallonsLiters($amt);
}
else {
	$original = "liters";
	$new = "galons";
	$newAmt = litersGallons($amt);
}

echo "<p>";
echo "<b>$amt</b> $original is <b>$newAmt</b> $new";
echo "</p>";

?>

        <footer>
                <p><a id="back" href="convertLiquid.html">Back</a></p>
                <br />
<?php
echo "<HR>";
highlight_file("convertLiquid.php");
?>

        </footer>
</body>
</html>

