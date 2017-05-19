<html>
<head>
	<title>Delete Contact</title>
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

$ind_id = $_REQUEST["ind_id"];
$conn_id = $_REQUEST["conn_id"];

deleteContact($ind_id, $conn_id);
?>

        <footer>
                <hr>
                <a id="back" href=".">Back</a>
                <a id="back" href="viewSources.php">View Sources</a>
        </footer>
</body>
</html>

<?php

function deleteContact($ind_id, $conn_id) {
	$conn = connectDB();

	$sql = "SELECT address_id FROM AddressConnection WHERE connection_id = $conn_id;";

	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$address_id = $row["address_id"];

	$sql = "DELETE FROM Individual WHERE ind_id = $ind_id;";
	$conn->query($sql);

	$sql = "DELETE FROM AddressConnection WHERE connection_id = $conn_id;";
	$conn->query($sql);

	$sql = "DELETE FROM Address
		WHERE address_id = $address_id
		AND NOT EXISTS (SELECT 1
				FROM AddressConnection
				WHERE address_id = $address_id);";
	$conn->query($sql);

	echo "<h4>Contact deleted</h4>";

	$conn->close();
}

?>
