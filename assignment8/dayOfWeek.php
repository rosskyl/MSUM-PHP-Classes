<html>
<head>
        <title>Day of Week</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="../navbarIframe.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
        <h1>Kyle Ross</h1>
        <h2>CSIS 311 Assignment 8</h2>
        <h3>Day of week calculator</h3>

        <iframe id="navbar" src="../navbar.html" scrolling="no" frameborder="0" border="0"></iframe>

<?php

$btn = $_REQUEST["btn"];

if ($btn == NULL || $btn == "Next Date")
	showDateInput();
else
	showDayOfWeek();


?>



        <footer>
                <hr>
                <p>
                        <a id="back" href=".">Back</a>
                        <a id="back" href="viewDayOfWeek.php">View Source</a>
                </p>
        </footer>
</body>
</html>



<?php
function selectNum($name, $start, $end, $step, $default=NULL) {
	echo "<select name='$name'>";
	if ($step > 0)
		for ($i=$start; $i<=$end; $i+=$step)
			if ($i == $default)
				echo "<option selected>$i</option>";
			else
				echo "<option>$i</option>";
	else
		for ($i=$start; $i>=$end; $i+=$step)
			if ($i == $default)
				echo "<option selected>$i</option>";
			else
				echo "<option>$i</option>";
	echo "</select>";
}

function showDateInput() {
	echo "<form><table><tr><th>Month</th><th>Day</th><th>Year</th></tr>";
	echo "<tr><td>";
	selectNum("month", 1, 12, 1, date("m"));
	echo "</td><td>";
	selectNum("day", 1, 31, 1, date("d"));
	echo "</td><td>";
	selectNum("year", 2100, 1900, -1, date("Y"));
	echo "</td>";
	echo "<td><input type='submit' name='btn' value='Enter Date'></td>";
	echo "</tr></table></form>";
}

function showDayOfWeek() {
	$month = $_REQUEST["month"];
	$day = $_REQUEST["day"];
	$year = $_REQUEST["year"];
	$date = mktime(0, 0, 0, $month, $day, $year);

	echo "<h4>" . date("F d, Y \i\s \a l", $date) . "</h4>";
	echo "<form><input type='submit' name='btn' value='Next Date'></form>";
}

?>
