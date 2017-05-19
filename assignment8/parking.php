<html>
<head>
        <title>Parking</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="../navbarIframe.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
        <h1>Kyle Ross</h1>
        <h2>CSIS 311 Assignment 8</h2>
        <h3>Parking Calculator</h3>

        <iframe id="navbar" src="../navbar.html" scrolling="no" frameborder="0" border="0"></iframe>

	<form>
<?php

$btn = $_REQUEST["btn"];

if ($btn == NULL || $btn == "Clear Totals") {
	$_REQUEST["numShort"] = 0;
	$_REQUEST["shortTotal"] = 0;
	$_REQUEST["numLong"] = 0;
	$_REQUEST["longTotal"] = 0;
	showBase();
}
elseif ($btn == "Short Term")
	inputShortTerm();
elseif ($btn == "Long Term")
	inputLongTerm();
elseif ($btn == "Submit") {
	calculateParking();
	showBase();
}

outputTotals();
passTotals();
?>

	</form>
        <footer>
                <hr>
                <p>
                        <a id="back" href=".">Back</a>
                        <a id="back" href="viewParking.php">View Source</a>
                </p>
        </footer>
</body>
</html>



<?php

function showBase() {
	echo <<< HELLO
	<h4>Do you have short term or long term?</h4>
	<p>Short term is measure in minutes and long term is measured in days.</p>
	<input type="submit" name="btn" value="Short Term">
	<input type="submit" name="btn" value="Long Term">
HELLO;
}

function inputShortTerm() {
	echo <<< HELLO
	<h4>Short term parking is charged $0.75 for each 15 minutes with a maximum charge of $15.</h4>
	<h5>Minutes parked: <input type="text" name="minutes" autocomplete="off" autofocus="on"></h5>
	<input type="submit" name="btn" value="Submit">
HELLO;
}

function inputLongTerm() {
	echo <<< HELLO
	<h4>Logn term parking is charged $8.00 for each day with a maximum charge of $45 a week.</h4>
	<h5>Days parked: <input type="text" name="days" autocomplete="off" autofocus="on"></h5>
	<input type="submit" name="btn" value="Submit">
HELLO;
}

function calculateParking() {
	if (isset($_REQUEST["minutes"])) {
		$minutes = $_REQUEST["minutes"];
		$charge = number_format(calculateShortTerm($minutes), 2);
		echo "<h4>It costs $$charge to park for $minutes minutes</h4>";
		$_REQUEST["numShort"] += 1;
		$_REQUEST["shortTotal"] += $charge;
	}
	else {
		$days = $_REQUEST["days"];
		$charge = number_format(calculateLongTerm($days), 2);
		echo "<h4>It costs $$charge to park for $days days</h4>";
		$_REQUEST["numLong"] += 1;
		$_REQUEST["longTotal"] += $charge;
	}
}

function outputTotals() {
	$numShort = $_REQUEST["numShort"];
	$shortTotal = number_format($_REQUEST["shortTotal"], 2);
	$numLong = $_REQUEST["numLong"];
	$longTotal = number_format($_REQUEST["longTotal"], 2);
	if ($numShort > 0)
		$avgShort = number_format($shortTotal / $numShort, 2);
	else
		$avgShort = 0;
	if ($numLong > 0)
		$avgLong = number_format($longTotal / $numLong, 2);
	else
		$avgLong = 0;

	echo <<< HELLO
	<hr>
	<h5>Number of short term customers: $numShort</h5>
	<h5>Total money collected from short term customers: $$shortTotal</h5>
	<h5>Average charge to short term customers: $$avgShort</h5>
	<h5>Number of long term customers: $numLong</h5>
	<h5>Total money collected from long term customers: $$longTotal</h5>
	<h5>Average charge to long term customers: $$avgLong</h5>
	<input type="submit" name="btn" value="Clear Totals">
HELLO;
}

function passTotals() {
	$numShort = $_REQUEST["numShort"];
	$shortTotal = $_REQUEST["shortTotal"];
	$numLong = $_REQUEST["numLong"];
	$longTotal = $_REQUEST["longTotal"];

	echo <<< HELLO
	<input type="hidden" name="numShort" value="$numShort">
	<input type="hidden" name="shortTotal" value="$shortTotal">
	<input type="hidden" name="numLong" value="$numLong">
	<input type="hidden" name="longTotal" value="$longTotal">
HELLO;
}

function calculateShortTerm($minutes) {
	$charge = 0;
	while ($minutes > 0) {
		$charge += .75;
		$minutes -= 15;
	}
	if ($charge > 15)
		return 15;
	else
		return $charge;
}

function calculateLongTerm($days) {
	$weekCharge = 0;
	while ($days > 7) {
		$weekCharge += 45;
		$days -= 7;
	}
	$dayCharge = 0;
	while ($days > 0) {
		$dayCharge += 8;
		$days -= 1;
	}
	if ($dayCharge > 45)
		$dayCharge = 45;
	return $weekCharge + $dayCharge;
}

?>
