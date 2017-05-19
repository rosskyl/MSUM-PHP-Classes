<html>
<head>
        <title>Quiz</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="../navbarIframe.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
        <h1>Kyle Ross</h1>
        <h2>CSIS 311 Assignment 11</h2>
	<h3>Quiz</h3>

        <iframe id="navbar" src="../navbar.html"></iframe>

<?php
require "questions.php";

session_start();

$btn = $_REQUEST["btn"];
if ($btn == NULL || $btn == "New Quiz") {
	session_unset();
	initialPage();
}
elseif ($btn == "Begin") {
	initializeVariables();
	displayQuestion();
}
elseif ($btn == "Submit Answer")
	checkAnswer();
elseif ($btn == "Next")
	displayQuestion();
elseif ($btn == "Quit")
	quit();
elseif ($btn == "Review Quiz")
	review();
elseif ($btn == "Display All Results" || $btn == "Cancel")
	displayAllResults();
elseif ($btn == "Clear All Results") {
	clearFile("allResults.txt");
	session_unset();
	initialPage();
}
elseif ($btn == "New Questions")
	newQuestions();
elseif ($btn == "Generate")
	displayGenerate();
?>

        <footer>
		<hr>
                <a id="back" href="..">Back</a>
		<a id="back" href="viewSources.php">View Sources</a>
        </footer>
</body>
</html>

<?php
function generateQuestions($file, $numQuestions, $min, $max, $title) {
	$out = fopen($file, "w");

	fwrite($out, "<?php\n\n\$title='$title';\n\n\$questions = array(\n");

	for ($i = 0; $i < $numQuestions-1; $i += 1) {
		$num1 = rand($min, $max);
		$num2 = rand($min, $max);
		$result = $num1 + $num2;
		$line = "'$num1 + $num2 = ' => $result,\n";
		fwrite($out, $line);
	}
	$result = $max + $min;
	$line = "'$min + $max = ' => $result\n";
	fwrite($out, $line);

	fwrite($out, ");\n\n?>\n");

	fclose($out);
}

function writeAllResults($file, $name, $numCorrect, $numQuestions) {
        $out = fopen($file, "a");

        $line = "$name got $numCorrect out of $numQuestions correct.\n";
        fwrite($out, $line);

        fclose($out);
}

function clearFile($file) {
        $f = fopen($file, "w");
        fclose($f);
}

function writeQuestionResult($file, $question, $ans, $result) {
        $line = "question: $question answer: $ans result: $result\n";
        $out = fopen($file, "a");
        fwrite($out, $line);
        fclose($out);
}

function readResults($file, &$correct, &$total) {
        $correct = 0;
        $total = 0;

        $in = fopen($file, "r");
        while ($line = fgets($in)) {
                $total += 1;
                if (strpos($line, "incorrect") == False)
                        $correct += 1;
        }
        fclose($in);
}

function initializeVariables() {
	$questions = $GLOBALS["questions"];
	$_SESSION["used"] = array();

	for ($i=0; $i<count($questions); $i+=1)
		$_SESSION["used"][$i] = False;

	$_SESSION["name"] = $_REQUEST["name"];

	clearFile("results.txt");
}

function getNextQuestion() {
	$questions = $GLOBALS["questions"];

	do
		$num = rand(0,count($questions)-1);
	while ($_SESSION["used"][$num]);
	$_SESSION["used"][$num] = true;
	reset($questions);
	for ($i=0; $i<$num; $i++)
		next($questions);
	return key($questions);
}

function allQuestionsUsed() {
	for ($i=0; $i<count($_SESSION["used"]); $i+=1)
		if ($_SESSION["used"][$i] == False)
			return False;
	return True;
}

function initialPage() {
	$title = $GLOBALS["title"];
	echo <<< HELLO
	<h3>Quiz $title</h3>
	<form>
		<h4>Enter your name: <input type="text" name="name" autocomplete="off" autofocus="on"></h4>
		<input type="submit" name="btn" value="Begin">
		<input type="submit" name="btn" value="Display All Results">
	</form>
HELLO;
}

function displayQuestion() {
	if (allQuestionsUsed())
		quit();
	else {

	$question = getNextQuestion();
	$_SESSION["currQuestion"] = $question;
	$name = $_SESSION["name"];
	$title = $GLOBALS["title"];

	echo <<< HELLO
	<h3>Quiz $title</h3>
	<form>
		<h4>Question: $question</h4>
		<h4>Answer: <input type="text" name="ans" autocomplte="off" autofocus="on"></h4>
		<input type="submit" name="btn" value="Submit Answer">
	</form>
HELLO;
	}
}

function checkAnswer() {
	$ans = $_REQUEST["ans"];
	$currQuestion = $_SESSION["currQuestion"];
	$questions = $GLOBALS["questions"];
	$name = $_SESSION["name"];
	$title = $GLOBALS["title"];
	$correctAns = $questions[$currQuestion];

	if ($ans == $correctAns)
		$result = "correct";
	else
		$result = "incorrect($correctAns)";

	echo <<< HELLO
	<h3>Quiz $title</h3>
	<h4>Question: $currQuestion</h4>
	<h4>Your answer: $ans $result</h4>
	<form>
		<input type="submit" name="btn" value="Next">
		<input type="submit" name="btn" value="Quit">
	</form>
HELLO;

	writeQuestionResult("results.txt", $currQuestion, $ans, $result);
}

function quit() {
	$name = $_SESSION["name"];
	$title = $GLOBALS["title"];

	readResults("results.txt", $correct, $total);

	echo <<< HELLO
	<h3>Quiz $title</h3>
	<h4>$name, you got $correct out of $total correct</h4>
	<form>
		<input type="submit" name="btn" value="Review Quiz">
		<input type="submit" name="btn" value="New Quiz">
	</form>
HELLO;

	writeAllResults("allResults.txt", $name, $correct, $total);
}

function review() {
	$name = $_SESSION["name"];
	$title = $GLOBALS["title"];

	echo "<h3>Quiz $title</h3><h4>Quiz Review</h4>";
	highlight_file("results.txt");
	echo "<br>";
	echo "<form><input type='submit' name='btn' value='New Quiz'>";
	echo "<input type='submit' name='btn' value='Display All Results'></form>";
}

function displayAllResults() {
	$title = $GLOBALS["title"];

	echo "<h3>Quiz $title</h3><h4>Quiz Results</h4>";
	highlight_file("allResults.txt");
	echo "<br>";
	echo "<form><input type='submit' name='btn' value='New Quiz'>";
	echo "<input type='submit' name='btn' value='Clear All Results'>";
	echo "<input type='submit' name='btn' value='New Questions'></form>";
}

function newQuestions() {
	echo <<< HELLO
	<form>
		<h4>Number of questions: <input type="text" name="numQuestions" autocomplete="off" autofocus="on"></h4>
		<h4>Max number: <input type="text" name="max" autocomplete="off"></h4>
		<h4>Min number: <input type="text" name="min" autocomplete="off"></h4>
		<input type="submit" name="btn" value="Generate">
		<input type="submit" name="btn" value="Cancel">
	<form>
HELLO;
}

function displayGenerate() {
	$num = $_REQUEST["numQuestions"];
	$max = $_REQUEST["max"];
	$min = $_REQUEST["min"];

	generateQuestions("questions.php", $num, $min, $max, "Math");

	echo <<< HELLO
	<h4>Questions generated</h4>
	<form>
		<input type="submit" name="btn" value="New Quiz">
	</form>
HELLO;
}

?>
