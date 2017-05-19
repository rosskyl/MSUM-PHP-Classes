<html>
<head>
        <title>Arrays</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="../navbarIframe.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
        <h1>Kyle Ross</h1>
        <h2>CSIS 311 Assignment 9</h2>
	<h3>Arrays</h3>

        <iframe id="navbar" src="../navbar.html"></iframe>

<?php

$btn = $_REQUEST["btn"];
if ($btn == NULL || $btn == "Start Over")
	getInfo();
elseif ($btn == "Go" || $btn == "New Numbers") {
	$_REQUEST["numbers"] = generateRandomArray($_REQUEST["cnt"], $_REQUEST["min"], $_REQUEST["max"]);
	displayArrayPage();
}
elseif ($btn == "Sort Ascending") {
	sort($_REQUEST["numbers"]);
	displayArrayPage();
}
elseif ($btn == "Sort Descending") {
	rsort($_REQUEST["numbers"]);
	displayArrayPage();
}
else
	displayArrayPage();
?>

        <footer>
                <a id="back" href="..">Back</a>
        </footer>
</body>
</html>

<?php

function biggest($numbers) {
	$big = $numbers[0];
	for ($i=1; $i<count($numbers); $i+=1)
		if ($numbers[$i] > $big)
			$big = $numbers[$i];
	return $big;
}

function smallest($numbers) {
	$small = $numbers[0];
	for ($i=1; $i<count($numbers); $i+=1)
		if ($numbers[$i] < $small)
			$small = $numbers[$i];
	return $small;
}

function sum($numbers) {
	$tot = 0;
	for ($i=0; $i<count($numbers); $i+=1)
		$tot += $numbers[$i];
	return $tot;
}

function average($numbers) {
	return sum($numbers) / count($numbers);
}

function median($numbers) {
	sort($numbers);
	$mid = count($numbers) / 2 - 1;
	if (count($numbers) % 2 == 1)
		return $numbers[number_format($mid, 0)];
	else
		return ($numbers[$mid] + $numbers[$mid+1]) / 2;
}

function myRange($numbers) {
	return biggest($numbers) - smallest($numbers);
}

function biggerThanAverage($numbers) {
	$avg = average($numbers);
	$cnt = 0;
	for ($i=0; $i<count($numbers); $i+=1)
		if ($numbers[$i] > $avg)
			$cnt += 1;
	return $cnt;
}

function smallerThanAverage($numbers) {
	$avg = average($numbers);
	$cnt = 0;
	for ($i=0; $i<count($numbers); $i+=1)
		if ($numbers[$i] < $avg)
			$cnt += 1;
	return $cnt;
}

function generateRandomArray($num, $min, $max) {
	$numbers = array();
	for ($i=0; $i<$num; $i+=1)
		$numbers[$i] = rand($min, $max);
	return $numbers;
}

function getInfo() {
	echo <<< HERE
	<form><fieldset>
		<h4>Enter your name: <input type="text" name="name" autocomplete="off" autofocus="on"></h4>
		<h4>How many numbers are in the array: <input type="text" name="cnt" autocomplete="off"></h4>
		<h4>What is the biggest possible value: <input type="text" name="max" autocomplete="off"></h4>
		<h4>What is the smallest possible value: <input type="text" name="min" autocomplete="off"></h4>
		<input type="submit" name="btn" value="Go">
	</fieldset></form>
HERE;
}

function displayArrayPage() {
	$name = $_REQUEST["name"];
	$numbers = $_REQUEST["numbers"];
	$cnt = $_REQUEST["cnt"];
	$min = $_REQUEST["min"];
	$max = $_REQUEST["max"];

	echo "<h3>$name's Array</h3>";
	echo "<h4>$cnt random numbers in the range $min to $max</h4>";

	echo "<table border='1'><tr><th>Array Index</th>";
	for ($i=0; $i<$cnt; $i+=1)
		echo "<th>[$i]</th>";
	echo "</tr><tr><td>Array Value</td>";
	for ($i=0; $i<$cnt; $i+=1)
		echo "<td> $numbers[$i]</td>";
	echo "</tr></table>";

	echo <<< HELLO
	<br>
	<form>
	<input type="submit" name="btn" value="New Numbers">
	<input type="submit" name="btn" value="Biggest">
	<input type="submit" name="btn" value="Smallest">
	<input type="submit" name="btn" value="Sum">
	<input type="submit" name="btn" value="Average">
	<input type="submit" name="btn" value="Median">
	<input type="submit" name="btn" value="Range">
	<input type="submit" name="btn" value="> Average">
	<input type="submit" name="btn" value="< Average">
	<input type="submit" name="btn" value="Sort Ascending">
	<input type="submit" name="btn" value="Sort Descending">
	<input type="submit" name="btn" value="Start Over">
HELLO;
	passData();
	echo "</form>";

	outputOtherInfo();
}

function passData() {
	$name = $_REQUEST["name"];
	$numbers = $_REQUEST["numbers"];
	$cnt = $_REQUEST["cnt"];
	$min = $_REQUEST["min"];
	$max = $_REQUEST["max"];

	echo <<< HELLO
	<input type="hidden" name="name" value="$name">
	<input type="hidden" name="cnt" value="$cnt">
	<input type="hidden" name="min" value="$min">
	<input type="hidden" name="max" value="$max">
HELLO;

	for ($i=0; $i<count($numbers); $i+=1)
		echo "<input type='hidden' name='numbers[$i]' value='$numbers[$i]'>";
}

function outputOtherInfo() {
	$btn = $_REQUEST["btn"];
	$name = $_REQUEST["name"];
	$numbers = $_REQUEST["numbers"];
	$cnt = $_REQUEST["cnt"];
	$min = $_REQUEST["min"];
	$max = $_REQUEST["max"];

	if ($btn == "Biggest")
		echo "<h4>The biggest is " . biggest($numbers) . "</h4>";
	elseif ($btn == "Smallest")
		echo "<h4>The smallest is " . smallest($numbers) . "</h4>";
	elseif ($btn == "Sum")
		echo "<h4>The sum is " . sum($numbers) . "</h4>";
	elseif ($btn == "Average")
		echo "<h4>The average is " . average($numbers) . "</h4>";
	elseif ($btn == "Median")
		echo "<h4>The median is " . median($numbers) . "<h4>";
	elseif ($btn == "Range")
		echo "<h4>The range of values (smallest to biggest) is " . myRange($numbers) . "</h4>";
	elseif ($btn == "> Average")
		echo "<h4>There are " . biggerThanAverage($numbers) . " values greater than the average</h4>";
	elseif ($btn == "< Average")
		echo "<h4>There are " . smallerThanAverage($numbers) . " values smaller than the average</h4>";
}

?>
