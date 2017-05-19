<html>
<head>
        <title>Game</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="../navbarIframe.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
        <h1>Kyle Ross</h1>
        <h2>CSIS 311 Assignment 10</h2>
	<h3>Animal Guessing Game</h3>

        <iframe id="navbar" src="../navbar.html"></iframe>

<?php

require "../sqlCredentials.php";

$btn = $_REQUEST["btn"];
if ($btn == NULL || $btn == "Start Over")
	initialPage();
elseif ($btn == "Submit Name" || $btn == "Play Again") {
	$_REQUEST["address"] = -1;
	displayQuestion();
}
elseif ($btn == "Yes" || $btn == "No") {
	$_REQUEST["address"] = getNextAddress($_REQUEST["address"], $btn);
	displayQuestion();
}
elseif ($btn == "Correct")
	displayLose();
elseif ($btn == "Incorrect")
	displayWin();
elseif ($btn == "Submit")
	displayQuestionAdded();

?>

        <footer>
		<hr>
                <a id="back" href="..">Back</a>
		<a id="back" href="viewSources.php">View Sources</a>
        </footer>
</body>
</html>

<?php

function connectDB() {
	$database = "rosskyl_311_assign10";

	$conn = mysqli_connect($GLOBALS["server"], $GLOBALS["username"], $GLOBALS["password"], $database);

	// Check connection
	if (!$conn)
	    die("Connection failed: " . mysqli_connect_error());

	return $conn;
}

function getNextQuestion($address,  &$resultType) {
	$conn = connectDB();

	$sql = "SELECT * FROM QuestionConnection WHERE connection_id = '$address';";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();

	$resultType = $row["object_type"];
	if ($resultType == "Question")
		$sql = "SELECT * FROM Question WHERE question_id = " . $row["object_id"];
	else
		$sql = "SELECT * FROM Solution WHERE solution_id = " . $row["object_id"];

	$result = $conn->query($sql);
	$row = $result->fetch_assoc();

	$conn->close();

	return $row["text"];
}

function getNextAddress($address, $btn) {
	if ($address == "-1")
		$address = "";
	if ($btn == "Yes")
		$address = $address . "1";
	else
		$address = $address . "0";
	return $address;
}

function getAllQuestions() {
	$questions = array();
	$conn = connectDB();

	$sql = "SELECT * FROM Question;";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc())
		$questions[$row["question_id"]] = $row["text"];

	$conn->close();
	return $questions;
}

function getAllSolutions() {
	$solutions = array();
	$conn = connectDB();

	$sql = "SELECT * FROM Solution;";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc())
		$solutions[$row["solution_id"]] = $row["text"];

	$conn->close();
	return $solutions;
}

function addQuestion() {
	$address = $_REQUEST["address"];
	$qType = $_REQUEST["qType"];
	$aType = $_REQUEST["aType"];
	$answer = $_REQUEST["answer"];

	$conn = connectDB();

	if ($qType == "custom") {
		$question = $_REQUEST["question"];
		$sql = "INSERT INTO Question (text) VALUES ('$question');";
		$conn->query($sql);
		$question_id = $conn->insert_id;
	}
	else
		$question_id = $_REQUEST["selQuestion"];

	if ($aType == "custom") {
		$animal = $_REQUEST["animal"];
		$sql = "INSERT INTO Solution (text) VALUES ('$animal');";
		$conn->query($sql);
		$animal_id = $conn->insert_id;
	}
	else
		$animal_id = $_REQUEST["selSolution"];

	$sql = "SELECT * FROM QuestionConnection WHERE connection_id = '$address';";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$old_solution_id = $row["object_id"];

	$sql = "UPDATE QuestionConnection SET object_id = $question_id, object_type = 'Question' WHERE connection_id = '$address';";
	$conn->query($sql);

	if ($answer == "yes") {
		$oldAddress = $address . "0";
		$newAddress = $address . "1";
	}
	else {
		$oldAddress = $address . "1";
		$newAddress = $address . "0";
	}

	$sql ="INSERT INTO QuestionConnection VALUES ('$oldAddress', $question_id, $old_solution_id, 'Solution'), ('$newAddress', $question_id, $animal_id, 'Solution');";
	$conn->query($sql);

	$conn->close();
}

function selectArray($name, $array) {
	echo "<select name='$name'>";
	foreach ($array as $index=>$value)
		echo "<option value='$index'>$value</option>";
	echo "</select>";
}

function passData() {
	$name = $_REQUEST["name"];
	$address = $_REQUEST["address"];

	echo <<< HELLO
		<input type="hidden" name="name" value="$name">
		<input type="hidden" name="address" value="$address">
HELLO;
}

function initialPage() {
	echo <<< HELLO
	<h4>Welcome to the Animal Game</h4>
	<p>I am going to try to guess what animal you are thinking of. Think of an
		animal and enter your name when you are ready.</p>
	<form>
		<h5>What is your name: <input type="text" name="name" autofocus="on" autocomplete="off"></h5>
		<input type="submit" name="btn" value="Submit Name">
	</form>
HELLO;
}

function displayQuestion() {
	$address = $_REQUEST["address"];
	$name = $_REQUEST["name"];
	$text = getNextQuestion($address, $type);
	if ($type == "Question") {
		echo <<< HELLO
		<h3>$name's Game</h3>
		<form>
			<h4>$text</h4>
			<input type="submit" name="btn" value="Yes">
			<input type="submit" name="btn" value="No">
HELLO;
	}
	else {
		echo <<< HELLO
		<form>
			<h4>Is '$text' your animal?</h4>
			<input type="submit" name="btn" value="Correct">
			<input type="submit" name="btn" value="Incorrect">
HELLO;
	}

	passData();
	echo "</form>";
}

function displayLose() {
	echo <<< HELLO
		<form>
			<h4>I win. It's okay to lose to a smarter computer.</h4>
			<input type="submit" name="btn" value="Play Again">
			<input type="submit" name="btn" value="Start Over">
HELLO;
	passData();
	echo "</form>";
}

function displayWin() {
	$text = getNextQuestion($_REQUEST["address"], $type);
	echo <<< HELLO
	<form>
		<h3>You win. Please help me learn for next time.</h3>
		<fieldset>
		<h4>What animal are you thinking of?</h4>
		<input type="text" name="animal" autocomplete="off" autofocus="on"><br><br>
HELLO;
	selectArray("selSolution", getAllSolutions());
	echo "</fieldset><fieldset><h4>What is a question to distinquish that animal from $text?</h4>";
	echo "<textarea name='question'></textarea></br></br>";
	selectArray("selQuestion", getAllQuestions());
	echo <<< HELLO
		</fieldset>
		<fieldset>
		<h4>What is the answer to this question for your animal?</h4>
		<select name="answer">
			<option>yes</option>
			<option>no</option>
		</select>
		</fieldset>
		<fieldset>
		<fieldset>
		<h4>Preset question or custom question?</h4>
		<input type="radio" name="qType" value="custom">Custom</br>
		<input type="radio" name="qType" value="preset">Preset</br>
		</fieldset>
		<fieldset>
		<h4>Preset animal or custom question?</h4>
		<input type="radio" name="aType" value="custom">Custom</br>
		<input type="radio" name="aType" value="preset">Preset</br>
		</fieldset>
		</fieldset>
		<input type="submit" name="btn" value="Submit">
HELLO;
	passData();
	echo "</form>";
}

function displayQuestionAdded() {
	addQuestion();

	echo <<< HELLO
	<h4>The question and animal have been added</h4>
	<form>
		<input type="submit" name="btn" value="Play Again">
		<input type="submit" name="btn" value="Start Over">
HELLO;
	passdata();
	echo "</form>";
}
?>
