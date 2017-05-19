<html>
<head>
	<title>Add Contact</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="../navbarIframe.css">
	<meta name="viewport" contents="width=display-width, initial-scale=1.0">
</head>

<body>
        <h1>Kyle Ross</h1>
        <h2>CSIS 311 Assignment 14</h2>
        <h3>Address Book</h3>

        <iframe id="navbar" src="../navbar.html" scrolling="no" frameborder="0" border="0"></iframe>

<?php
require "functions.php";

$btn = $_REQUEST["btn"];

if ($btn == NULL)
	displayInitialForm();
else
	addContact();

?>

        <footer>
                <hr>
                <a id="back" href=".">Back</a>
                <a id="back" href="viewSources.php">View Sources</a>
        </footer>
</body>
</html>

<?php

function displayInitialForm() {
	echo <<< HELLO
	<form action="addContact.php" method="post">
	<fieldset>
	<legend>Add Contact</legend>
	<fieldset>
		<legend>Name</legend>
		<h4>First name<input type="text" name="fname"></h4>
		<h4>Last name<input type="text" name="lname"></h4>
	</fieldset>
	<fieldset>
		<legend>Address</legend>
		<h4>Street<input type="text" name="street1"></h4>
		<h4>Street<input type="text" name="street2"></h4>
		<h4>City<input type="text" name="city"></h4>
		<h4>State <select name="state">
			<option>IA</option>
			<option>MN</option>
			<option>ND</option>
			<option>SD</option>
		</select></h4>
		<h4>Zip code<input type="text" name="zip"></h4>
	</fieldset>
	<input type="submit" value="Submit" name="btn">
	<input type="reset" value="Reset">
	</fieldset>
	</form>
HELLO;
}

function addContact() {
	extract($_REQUEST);

	$conn = connectDB();

	$sql = "INSERT INTO Individual (f_name, l_name)
		VALUES ('$fname', '$lname');";
	$conn->query($sql);
	$ind_id = $conn->insert_id;

	$sql = "INSERT INTO Address (line_1, line_2, city, state_cd, zip_cd)
		VALUES ('$street1', '$street2', '$city', '$state', '$zip');";
	$conn->query($sql);
	$address_id = $conn->insert_id;

	$sql = "INSERT INTO AddressConnection (ind_id, address_id)
		VALUES ($ind_id, $address_id);";
	$conn->query($sql);

	$conn->close();

	echo "<h4>Contact added</h4>";
}

?>
