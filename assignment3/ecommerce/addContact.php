<html>
	<link rel="stylesheet" href="navbarIframe.css">
	<link rel="stylesheet" href="styles.css">

<body>

        <iframe id="navbar" src="navbar.html" scrolling="no" frameborder="0" border="0"></iframe>

<?php
include 'functions.php';

$fname = $_REQUEST["fname"];
$lname = $_REQUEST["lname"];

$phone = $_REQUEST["phone"];
$phoneType = $_REQUEST["phoneType"];

$street1 = $_REQUEST["street1"];
$street2 = $_REQUEST["street2"];
$city = $_REQUEST["city"];
$state = $_REQUEST["state"];
$zip = $_REQUEST["zip"];

$notes = $_REQUEST["notes"];

$filename = "contacts/" . $fname . "_" . $lname . ".txt";
writeFile($filename, $fname, $lname, $phone, $phoneType,
	$street1, $street2, $city, $state, $zip, $notes);

echo "<p>Contact saved</p>";

?>



	<footer>
<?php
echo "<HR>";
highlight_file("addContact.php");
?>

        </footer>
</body>
</html>
