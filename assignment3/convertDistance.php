<html>
<head>
        <title>Convert Distance</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="../navbarIframe.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
        <h1>Kyle Ross</h1>
        <h2>CSIS 311 Assignment 3</h2>
        <h3>Convert Distance</h3>

        <iframe id="navbar" src="../navbar.html" scrolling="no" frameborder="0" border="0"></iframe>

<?php
$dist = $_REQUEST["dist"];
$button = $_REQUEST["submit"];

if ($button == "Inches to Centimeters") {
	$original = "inches";
	$new = "centimeters";
	$newDist = $dist * 2.54;
}
else {
	$original = "centimeters";
	$new = "inches";
	$newDist = $dist / 2.54;
}

echo "<p>";
echo "<b>$dist</b> $original is <b>$newDist</b> $new";
echo "</p>";

?>

        <footer>
                <p><a id = "back" href="convertDistance.html">Back</a></p>
                <br />
<?php
echo "<HR>";
highlight_file("convertDistance.php");
?>

        </footer>
</body>
</html>

