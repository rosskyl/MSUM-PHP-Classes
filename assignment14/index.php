<html>
<head>
        <title>Address Book</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="../navbarIframe.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
        <h1>Kyle Ross</h1>
        <h2>CSIS 311 Assignment 14</h2>
	<h3>Address Book</h3>

        <iframe id="navbar" src="../navbar.html"></iframe>

        <form>
        <fieldset>
                <legend>Fields</legend>
                <h4>Select the fields you would like to view</h4>
                <input type="checkbox" name="showFname" checked>Show First Name
                <input type="checkbox" name="showLname" checked>Show Last Name
                <input type="checkbox" name="showAddress1">Show Address 1
                <input type="checkbox" name="showAddress2">Show Address 2
                <input type="checkbox" name="showCity">Show City
                <input type="checkbox" name="showState">Show State
                <input type="checkbox" name="showZip">Show Zip Code
	        <br /><br />
                <input type="submit" value="Refresh" name="btn">
                <input type="reset">
        </fieldset>
        </form>

	<form action="addContact.php">
		<input type="submit" value="Add Contact">
	</form>

<?php

require "functions.php";

$btn = $_REQUEST["btn"];

if ($btn == NULL)
	displayContacts(1, 1, 0, 0, 0, 0, 0);
elseif ($btn == "Refresh")
	displayContacts(isset($_REQUEST["showFname"]), isset($_REQUEST["showLname"]),
		isset($_REQUEST["showAddress1"]), isset($_REQUEST["showAddress2"]),
		isset($_REQUEST["showCity"]), isset($_REQUEST["showState"]),
		isset($_REQUEST["showZip"]));

?>

        <footer>
		<hr>
                <a id="back" href="..">Back</a>
		<a id="back" href="viewSources.php">View Sources</a>
        </footer>
</body>
</html>

<?php

function displayContacts($isFName, $isLName, $isAddress1, $isAddress2, $isCity, $isState, $isZip) {
	$conn = connectDB();

	echo "<table border='1'><tr class='tableHeader'>";

	$cols = array("i.ind_id", "ac.connection_id");
	if ($isFName == 1) {
		$cols[] = "i.f_name";
		echo "<th>First Name</th>";
	}
	if ($isLName == 1) {
		$cols[] = "i.l_name";
		echo "<th>Last Name</th>";
	}
	if ($isAddress1 == 1) {
		$cols[] = "a.line_1";
		echo "<th>Address Line 1</th>";
	}
	if ($isAddress2 == 1) {
		$cols[] = "a.line_2";
		echo "<th>Address Line 2</th>";
	}
	if ($isCity == 1) {
		$cols[] = "a.city";
		echo "<th>City</th>";
	}
	if ($isState == 1) {
		$cols[] = "a.state_cd";
		echo "<th>State</th>";
	}
	if ($isZip == 1) {
		$cols[] = "a.zip_cd";
		echo "<th>Zip Code</th>";
	}

	$sql = "SELECT " . implode(", ", $cols);
	$sql = $sql . " FROM Individual i
			JOIN AddressConnection ac ON i.ind_id = ac.ind_id
			JOIN Address a ON ac.address_id = a.address_id
			ORDER BY i.l_name, i.f_name, a.city;";

	$result = $conn->query($sql);

	while ($row = $result->fetch_assoc()) {
		echo "<tr>";
		foreach ($row as $col=>$val)
			if ($col != "ind_id" && $col != "connection_id") {
				$ind_id = $row["ind_id"];
				$conn_id = $row["connection_id"];
				echo "<td><a href='viewContact.php?ind_id=$ind_id&conn_id=$conn_id'>$val</a></td>";
			}
		echo "</tr>";
	}
	echo "</table>";

	$conn->close();
}

?>
