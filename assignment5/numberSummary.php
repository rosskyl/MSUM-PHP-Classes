<html>
<head>
        <title>Number Summary</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="../navbarIframe.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
        <h1>Kyle Ross</h1>
        <h2>CSIS 311 Assignment 5</h2>
        <h3>Number Summary</h3>

        <iframe id="navbar" src="../navbar.html" scrolling="no" frameborder="0" border="0"></iframe>

        <form action="numberSummary.php">
		<fieldset>
			<h4>Enter a number<input type="text" name="num" autocomplete="off"></h4>
			<input type="submit" name="submit" value="Submit">
			<input type="submit" name="submit" value="Start Over">
		</fieldset>
	</form>
<?php
session_start();

if (isset($_REQUEST["submit"]) && $_REQUEST["submit"] == "Submit") {
	$num = $_REQUEST["num"];
	$_SESSION["count"] += 1;
	$_SESSION["sum"] += $num;
	if ($_SESSION["largest"] < $num || $_SESSION["largest"] == NULL)
		$_SESSION["largest"] = $num;
	if ($_SESSION["smallest"] > $num || $_SESSION["smallest"] == NULL)
		$_SESSION["smallest"] = $num;

	$ct = $_SESSION["count"];
	$sum = $_SESSION["sum"];
	$largest = $_SESSION["largest"];
	$smallest = $_SESSION["smallest"];
	$avg = number_format($sum / $ct, 2);

echo <<< HERE
	<h4>The last number entered was <b>$num</b></h4>
	<h4>The number of values entered is <b>$ct</b></h4>
	<h4>The running sum is <b>$sum</b></h4>
	<h4>The average is <b>$avg</b></h4>
	<h4>The biggest is <b>$largest</b></h4>
	<h4>The smallest is <b>$smallest</b></h4>
HERE;
}
elseif (isset($_REQUEST["submit"]) && $_REQUEST["submit"] == "Start Over") {
	$_SESSION["count"] = 0;
	$_SESSION["sum"] = 0;
	$_SESSION["largest"] = NULL;
	$_SESSION["smallest"] = NULL;
}
else {
	$_SESSION["count"] = 0;
	$_SESSION["sum"] = 0;
	$_SESSION["largest"] = NULL;
	$_SESSION["smallest"] = NULL;
}



?>
        <footer>
                <form action="viewNumberSummary.php">
                        <a id="back" href=".">Back</a>
                        <input id="back" type="submit" value="View Source">
                </form>
        </footer>
</body>
</html>


