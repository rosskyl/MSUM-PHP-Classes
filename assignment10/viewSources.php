<html>
<head>
        <title>Sources</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="../navbarIframe.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
        <h1>Kyle Ross</h1>
        <h2>CSIS 311 Assignment 10</h2>
	<h3>Sources</h3>

        <iframe id="navbar" src="../navbar.html"></iframe>

	<form>
		<h4>Pick what you would like to see:</h4>
		<input type="submit" name="btn" value="Questions">
		<input type="submit" name="btn" value="Solutions">
		<input type="submit" name="btn" value="QuestionConnection">
		<input type="submit" name="btn" value="View Database Schema">
		<input type="submit" name="btn" value="View index.php">
	</form>

<?php

require "../sqlCredentials.php";

$database = "rosskyl_311_assign10";

$conn = mysqli_connect($server, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$btn = $_REQUEST["btn"];

if ($btn == "Questions")
	showQuestions($conn);
elseif ($btn == "Solutions")
	showSolutions($conn);
elseif ($btn == "QuestionConnection")
	showQuestionConnection($conn);
elseif ($btn == "View Database Schema") {
	echo "<h4>createTables.sql</h4>";
	highlight_file("createTables.sql");
}
elseif ($btn == "View index.php") {
	echo "<h4>index.php</h4>";
	highlight_file("index.php");
}

$conn->close();
?>

        <footer>
                <a id="back" href=".">Back</a>
        </footer>
</body>
</html>

<?php

function showQuestions(&$conn) {
	echo "<h4>Questions</h4>";

	$sql = "SELECT * FROM Question;";

	$results = $conn->query($sql);

	echo "<table border='1'><tr><th>question_id</th><th>text</th></tr>";

	if ($results->num_rows > 0)
		while ($row = $results->fetch_assoc())
			echo "<tr><td>" . $row["question_id"] . "</td><td>"
				. $row["text"] . "</td></tr>";
	echo "</table>";
}

function showSolutions($conn) {
	echo "<h4>Solutions</h4>";

	$sql = "SELECT * FROM Solution;";

	$results = $conn->query($sql);

	echo "<table border='1'><tr><th>solution_id</th><th>text</th></tr>";

	if ($results->num_rows > 0)
		while ($row = $results->fetch_assoc())
			echo "<tr><td>" . $row["solution_id"] . "</td><td>"
				. $row["text"] . "</td></tr>";
	echo "</table>";
}

function showQuestionConnection($conn) {
	echo "<h4>QuestionConnection</h4>";

	$sql = "SELECT * FROM QuestionConnection;";

	$results = $conn->query($sql);

	echo "<table border='1'><tr><th>connection_id</th><th>parent_id</th>";
	echo "<th>object_id</th><th>object_type</th></tr>";

	if ($results->num_rows > 0)
		while ($row = $results->fetch_assoc())
			echo "<tr><td>" . $row["connection_id"] . "</td><td>"
				. $row["parent_id"] . "</td><td>"
				. $row["object_id"] . "</td><td>"
				. $row["object_type"] . "</td></tr>";
	echo "</table>";
}

?>
