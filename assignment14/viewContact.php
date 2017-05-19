<html>
<head>
	<title>View Contact</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="../navbarIframe.css">
	<meta name="viewport" contents="width=display-width, initial-scale=1.0">

<?php
require "functions.php";

$ind_id = $_REQUEST["ind_id"];
$conn_id = $_REQUEST["conn_id"];
getContact($ind_id, $conn_id, $fname, $lname, $street1, $street2, $city, $state, $zip);

?>

</head>

<body>
        <h1>Kyle Ross</h1>
        <h2>CSIS 311 Assignment 14</h2>
        <h3>Address Book</h3>

        <iframe id="navbar" src="../navbar.html" scrolling="no" frameborder="0" border="0"></iframe>

	<form action="addContact.php" method="post">
	<fieldset>
	<legend>Edit Contact</legend>
	<fieldset>
		<legend>Name</legend>
		<h4>First name<input type="text" name="fname" value="<?php echo "$fname";?>"></h4>
		<h4>Last name<input type="text" name="lname" value="<?php echo "$lname";?>"></h4>
	</fieldset>
	<fieldset>
		<legend>Address</legend>
		<h4>Street<input type="text" name="street1" value="<?php echo "$street1";?>"></h4>
		<h4>Street<input type="text" name="street2" value="<?php echo "$street2";?>"></h4>
		<h4>City<input type="text" name="city" value="<?php echo "$city";?>"></h4>
		<h4>State<input type="text" name="state" value="<?php echo "$state";?>"></h4>
		<h4>Zip code<input type="text" name="zip" value="<?php echo "$zip";?>"></h4>
	</fieldset>
	</form>
	<form action="deleteContact.php">
		<input type="submit" value="Delete Contact">
		<?php
			echo "<input type='hidden' name='ind_id' value='$ind_id'>";
			echo "<input type='hidden' name='conn_id' value='$conn_id'>";
		?>
	</fieldset>
	</form>

        <footer>
                <hr>
                <a id="back" href=".">Back</a>
                <a id="back" href="viewSources.php">View Sources</a>
        </footer>
</body>
</html>

<?php

function getContact($ind_id, $conn_id, &$fname, &$lname, &$street1, &$street2, &$city, &$state, &$zip) {
	$conn = connectDB();

	$sql = "SELECT *
		FROM Individual i
                	JOIN AddressConnection ac ON i.ind_id = ac.ind_id
                        JOIN Address a ON ac.address_id = a.address_id
		WHERE i.ind_id = $ind_id
			AND ac.connection_id = $conn_id;";

	$result = $conn->query($sql);
	$row = $result->fetch_assoc();

	$fname = $row["f_name"];
	$lname = $row["l_name"];
	$street1 = $row["line_1"];
	$street2 = $row["line_2"];
	$city = $row["city"];
	$state = $row["state_cd"];
	$zip = $row["zip_cd"];

	$conn->close();
}
?>
