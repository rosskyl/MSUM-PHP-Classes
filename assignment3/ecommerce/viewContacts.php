<html>
<head>
	<title>Contacts</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="navbarIframe.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<style>
input[type="checkbox"] {
	margin-left: 15px;
}
</style>

<body>

        <iframe id="navbar" src="navbar.html" scrolling="no" frameborder="0" border="0"></iframe>

	<form action="viewContacts.php?seen=1" method="post">
	<fieldset>
		<legend>Fields</legend>
		<h4>Select the fields you would like to view</h4>
		<input type="checkbox" name="showFname" checked>Show First Name
		<input type="checkbox" name="showLname" checked>Show Last Name
		<input type="checkbox" name="showPhone">Show Phone Number
		<input type="checkbox" name="showCity">Show City
		<input type="checkbox" name="showState">Show State
		<input type="checkbox" name="showNotes">Show Notes
		<br /><br />
		<input type="submit" value="Refresh">
		<input type="reset">
	</fieldset>
	</form>

	<table border="1">
		<tr class="tableHeader">
<?php
include 'functions.php';

//to at least show the first name of each person
if ($_REQUEST["seen"] != 1) {
	$_REQUEST["showFname"] = "on";
	$_REQUEST["showLname"] = "on";
}

$files = scandir("contacts/");
array_splice($files, 0, 2);//this removes the entries for "." and ".."

if (isset($_REQUEST["showFname"]))
	echo "<th>First Name</th>";
if (isset($_REQUEST["showLname"]))
	echo "<th>Last Name</th>";
if (isset($_REQUEST["showPhone"]))
	echo "<th>Phone Number</th>";
if (isset($_REQUEST["showCity"]))
	echo "<th>City</th>";
if (isset($_REQUEST["showState"]))
	echo "<th>State</th>";
if (isset($_REQUEST["showNotes"]))
	echo "<th>Notes</th>";

echo "</tr>";

for ($i = 0; $i < count($files); $i++) {
	$filename = "contacts/" . $files[$i];
	parseFilename($files[$i], $fname, $lname);
	if ($_REQUEST["seen"] == 1)
		readFileContents($filename, $fname, $lname, $phone,
		        $phoneType, $street1, $street2, $city, $state, $zip,
		        $notes);

	echo "<tr>";
	if (isset($_REQUEST["showFname"]))
		echo "<td><a href='editContact.php?filename=$filename'>$fname</a></td>";
	if (isset($_REQUEST["showLname"]))
		echo "<td><a href='editContact.php?filename=$filename'>$lname</a></td>";
	if (isset($_REQUEST["showPhone"]))
		echo "<td><a href='editContact.php?filename=$filename'>$phone</a></td>";
	if (isset($_REQUEST["showCity"]))
		echo "<td><a href='editContact.php?filename=$filename'>$city</a></td>";
	if (isset($_REQUEST["showState"]))
		echo "<td><a href='editContact.php?filename=$filename'>$state</a></td>";
	if (isset($_REQUEST["showNotes"]))
		echo "<td><a href='editContact.php?filename=$filename'>$notes</a></td>";
	echo "</tr>";
}
?>
	</table>

	<footer>
<?php
echo "<HR>";
highlight_file("viewContacts.php");
?>

        </footer>


</body>
</html>
