<?php
require "../sqlCredentials.php";

function connectDB() {
        $database = "rosskyl_address_book";

        $conn = mysqli_connect($GLOBALS["server"], $GLOBALS["username"], $GLOBALS["password"], $database);

        // Check connection
        if (!$conn)
            die("Connection failed: " . mysqli_connect_error());

        return $conn;
}

?>
