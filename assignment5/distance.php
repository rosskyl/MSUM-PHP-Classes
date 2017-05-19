<html>
<head>
        <title>Convert Distance</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="../navbarIframe.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php

function milesToKilometers($dist) {
	return number_format($dist * 1.609344, 2);
}

function kilometersToMiles($dist) {
	return number_format($dist / 1.609344, 2);
}

?>

</head>
<body>
        <h1>Kyle Ross</h1>
        <h2>CSIS 311 Assignment 5</h2>
        <h3>Convert Distance</h3>

        <iframe id="navbar" src="../navbar.html" scrolling="no" frameborder="0" border="0"></iframe>

	<form action="distance.php">
<?php
if (!isset($_REQUEST["submit"])) {
	echo "<fieldset><h4>Distance<input type='text' name='dist' autocomplete='off'></h4>";
	echo "<input type='submit' name='submit' value='Miles to Kilometers'>";
	echo "<input type='submit' name='submit' value='Kilometers to Miles'>";
	echo "</fieldset>";
}
else {

	$dist = $_REQUEST["dist"];
	$button = $_REQUEST["submit"];

	if ($dist == NULL)
		echo "<h4>You need to enter a value for the distance.</h4>";
	else {
		if ($button == "Miles to Kilometers") {
			$original = "miles";
			$new = "kilometers";
			$newDist = milesToKilometers($dist);
		}
		else {
			$original = "kilometers";
			$new = "miles";
			$newDist = kilometersToMiles($dist);
		}
		echo "<p>";
		echo "<b>$dist</b> $original is <b>$newDist</b> $new";
		echo "</p>";
	}
	echo "<input type='submit' value='Back to Form'>";

}
?>
	</form>
        <footer>
		<form action="viewDistance.php">
	                <a id="back" href=".">Back</a>
			<input id="back" type="submit" value="View Source">
		</form>
        </footer>
</body>
</html>

