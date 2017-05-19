<!--

I am just curios if it is better to change variable data the way I do it (which
is changing them in $_REQUEST) or if it is better to extract everything and
pass each variable as pass by reference if it changes in a function?

-->





<html>
<head>
	<title>Number guessing</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="../navbarIframe.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
		if ($_REQUEST["button"] == NULL)
			firstLoad();
		elseif ($_REQUEST["button"] == "Restart Game")
			restartGame();
		else
			extractData();
	?>
</head>
<body>
	<h1>Kyle Ross</h1>
	<h2>CSIS 311 Assignment 6</h2>
	<h3>Number Guessing</h3>

	<iframe id="navbar" src="../navbar.html" scrolling="no" frameborder="0" border="0"></iframe>

	<h3>Guess a number between 1 and 1000</h3>

	<div class="inlined"><form method="post"><fieldset>
		<h4>Guess<input type="text" name="num" autocomplete="off" autofocus="on"></h4>
		<?php numberOfGuesses(); ?>
		<input type="submit" name="button" value="Submit">
		<input type="submit" name="button" value="Restart Game">
		<?php saveVariables(); ?>
	</fieldset></form></div>
	<div class="inlined">
		<?php displayResults(); ?>
	</div>

	<footer>
		<hr>
		<p>
			<a id="back" href="..">Back</a>
			<a id="back" href="viewIndex.php">View Source</a>
		</p>
	</footer>
</body>
</html>

<?php
function firstLoad() {
	$_REQUEST["numGuesses"] = 0;
	$_REQUEST["displayString"] = "";
	$_REQUEST["randomNumber"] = rand(1, 1000);
	$_REQUEST["totGuesses"] = 0;
	$_REQUEST["numGames"] = 0;
}

function restartGame() {
	$_REQUEST["totGuesses"] += $_REQUEST["numGuesses"];
	$_REQUEST["numGuesses"] = 0;
	$_REQUEST["displayString"] = "";
	$_REQUEST["randomNumber"] = rand(1, 1000);
	$_REQUEST["numGames"] += 1;
}

function extractData() {
	if ($_REQUEST["num"] != NULL) {
		$_REQUEST["numGuesses"] = $_REQUEST["numGuesses"] + 1;
		$num = $_REQUEST["num"];
		$randomNumber = $_REQUEST["randomNumber"];
		$displayString = $_REQUEST["displayString"];
		if ($num < $randomNumber)
			$result = "too low";
		elseif ($num > $randomNumber)
			$result = "too high";
		else {
			$result = "correct!\n";
			$result = $result . "It took you " . $_REQUEST["numGuesses"] . " guesses";
		}
		$displayString = $displayString . $num . " is " . $result . "\n";
		$_REQUEST["displayString"] = $displayString;
	}
}

function saveVariables() {
	$displayString = $_REQUEST["displayString"];
	$randomNumber = $_REQUEST["randomNumber"];
	$numGuesses = $_REQUEST["numGuesses"];
	$numGames = $_REQUEST["numGames"];
	$totGuesses = $_REQUEST["totGuesses"];
	echo <<< HELLO
		<input type="hidden" name="numGuesses" value="$numGuesses">
		<input type="hidden" name="displayString" value="$displayString">
		<input type="hidden" name="randomNumber" value="$randomNumber">
		<input type="hidden" name="numGames" value="$numGames">
		<input type="hidden" name="totGuesses" value="$totGuesses">
HELLO;
}

function numberOfGuesses() {
	$numGuesses = $_REQUEST["numGuesses"];
	$numGames = $_REQUEST["numGames"];
	if ($numGames == 0)
		$avgGuesses = 0;
	else
		$avgGuesses = number_format($_REQUEST["totGuesses"] / $numGames, 2);
	echo "<h4>Number of guesses: $numGuesses</h4>";
	echo "<h4>Number of games played: $numGames</h4>";
	echo "<h4>Average number of guesses: $avgGuesses</h4>";
}

function displayResults() {
	$displayString = $_REQUEST["displayString"];
	echo "<textarea rows='25' cols='50'>$displayString</textarea>";
}
?>
