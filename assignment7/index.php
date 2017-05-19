<html>
<head>
        <title>Math Quiz</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="../navbarIframe.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
        <h1>Kyle Ross</h1>
        <h2>CSIS 311 Assignment 7</h2>
        <h3>Math Quiz</h3>

        <iframe id="navbar" src="../navbar.html" scrolling="no" frameborder="0" border="0"></iframe>



<?php
$btn = $_REQUEST["btn"];
if ($btn == NULL || $btn == "Start Over")
	nameForm();
elseif ($btn == "Start" || $btn == "Next Problem") {
	$_REQUEST["num1"] = rand(1, 9);
	$_REQUEST["num2"] = rand(1, 9);
	showQuestion();
}
elseif ($btn == "Check Answer")
	checkAnswer();
elseif ($btn == "Try Again")
	showQuestion();
elseif ($btn == "Show Answer")
	showAnswer();
elseif ($btn == "Clear Results") {
	$_REQUEST["problems"] = 0;
	$_REQUEST["correct"] = 0;
	$_REQUEST["num1"] = rand(1, 9);
	$_REQUEST["num2"] = rand(1, 9);
	showQuestion();
}
?>

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

function nameForm() {
	echo <<< HELLO
	<form>
		<h3>Enter your name to start</h3>
		<h4>Name<input type="text" name="name" autocomplete="off" autofocus="on"></h4>
		<input type="submit" name="btn" value="Start">
		<input type="hidden" name="problems" value="0">
		<input type="hidden" name="correct" value="0">
	</form>
HELLO;
}

function showQuestion() {
	$name = $_REQUEST["name"];
	$num1 = $_REQUEST["num1"];
	$num2 = $_REQUEST["num2"];
	$retries = $_REQUEST["retries"];
	$problems = $_REQUEST["problems"];
	$correct = $_REQUEST["correct"];

	if ($_REQUEST["btn"] != "Try Again") {
		$problems += 1;
		$retries = 0;
	}
	else
		$retries += 1;
	$_REQUEST["retries"] = $retries;

	echo <<< HELLO
	<h3>$name's Multiplication Quiz</h3>
	<form>
		<h4>$num1 * $num2 = <input type="text" name="answer" autocomplete="off" autofocus="on"></h4>
		<input type="submit" name="btn" value="Check Answer">
		<input type="hidden" name="name" value="$name">
		<input type="hidden" name="num1" value="$num1">
		<input type="hidden" name="num2" value="$num2">
		<input type="hidden" name="problems" value="$problems">
		<input type="hidden" name="correct" value="$correct">
		<input type="hidden" name="retries" value="$retries">
	</form>
HELLO;
	showTotals();
}

function checkAnswer() {
	$name = $_REQUEST["name"];
	$num1 = $_REQUEST["num1"];
	$num2 = $_REQUEST["num2"];
	$answer = $_REQUEST["answer"];
	$retries = $_REQUEST["retries"];
	$problems = $_REQUEST["problems"];
	$correct = $_REQUEST["correct"];

	if ($answer == $num1 * $num2) {
		$result = "correct";
		$correct += 1;
		$_REQUEST["correct"] += 1;
	}
	else
		$result = "incorrect";

	echo <<< HELLO
	<h3>$name's Multiplication Quiz</h3>
	<form>
		<h4>$num1 * $num2 = $answer is $result</h4>
		<input type="submit" name="btn" value="Next Problem" autofocus="on">
HELLO;
	if ($result == "incorrect") {
		echo "<input type='submit' name='btn' value='Try Again'>";
		echo "<input type='submit' name='btn' value='Show Answer'>";
	}
	echo <<< HELLO
		<input type="submit" name="btn" value="Start Over">
		<input type="submit" name="btn" value="Clear Results">
		<input type="hidden" name="name" value="$name">
		<input type="hidden" name="num1" value="$num1">
		<input type="hidden" name="num2" value="$num2">
		<input type="hidden" name="problems" value="$problems">
		<input type="hidden" name="correct" value="$correct">
		<input type="hidden" name="retries" value="$retries">
	</form>
HELLO;
	showTotals();
}

function showAnswer() {
	$name = $_REQUEST["name"];
	$num1 = $_REQUEST["num1"];
	$num2 = $_REQUEST["num2"];
	$retries = $_REQUEST["retries"];
	$problems = $_REQUEST["problems"];
	$correct = $_REQUEST["correct"];
	$result = $num1 * $num2;

	echo <<< HELLO
	<h3>$name's Multiplication Quiz</h3>
	<form>
		<h4>$num1 * $num2 = $result</h4>
		<input type="submit" name="btn" value="Next Problem" autofocus="on">
		<input type="submit" name="btn" value="Start Over">
		<input type="submit" name="btn" value="Clear Results">
		<input type="hidden" name="name" value="$name">
		<input type="hidden" name="num1" value="$num1">
		<input type="hidden" name="num2" value="$num2">
		<input type="hidden" name="problems" value="$problems">
		<input type="hidden" name="correct" value="$correct">
		<input type="hidden" name="retries" value="$retries">
	<form>
HELLO;

	showTotals();
}

function showTotals() {
	$retries = $_REQUEST["retries"];
	$problems = $_REQUEST["problems"];
	$correct = $_REQUEST["correct"];

	if ($problems == 0)
		$percentage = 0;
	else
		$percentage = number_format($correct / $problems * 100, 2);

	echo "<h4>Problems: $problems</h4>";
	echo "<h4>Correct: $correct</h4>";
	echo "<h4>Percentage: $percentage%</h4>";
	if ($_REQUEST["retries"] > 0)
		echo "<h4>Retries for this question: $retries</h4>";
}

?>

