<html>
<head>
        <title>Dump Database</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="../navbarIframe.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
        <h1>Kyle Ross</h1>
        <h2>CSIS 311 Assignment 12</h2>
        <h3>Dump Database</h3>

        <iframe id="navbar" src="../navbar.html"></iframe>
<?php
require "../sqlCredentials.php";
$dbname = "rosskyl_address_book"; // replace with your database name

$conn = mysqli_connect("localhost",$username,$password,$dbname);

$sql = "SELECT table_name FROM information_schema.tables where table_schema='$dbname';";
$result = mysqli_query($conn, $sql);

extract($_POST);
echo <<< HERE
   <form method="POST"> 
   <h2>Database: $dbname</h2>
   <h2>View Tables: 
HERE;

$tables = array();
$cnt = 1;//Need to use 1 otherwise array_search returns 0 for first one which is same as FALSE
while ($row = mysqli_fetch_assoc($result)) {
	$tables[$cnt] = $row["table_name"];
	$cnt += 1;
	echo "<input type='submit' name='button' value='" . $row["table_name"] . "'>\n";
}

echo <<< HERE
   </h2>
   </form>
   <form action="..">
      <input type="submit" value="return to assignment index">
   </form>
HERE;

if (array_search($button, $tables) != FALSE)
{
   echo <<< HERE
      <form method="POST"> 
      <input type="submit" name="button" value="clear">
      </form>
HERE;
   $table = $button;

   $sql = "select * from $table";
   $result = mysqli_query($conn,$sql);
   
   // output the field names
   echo "<h3>Field Names in the $table table</h3>";
   while ($field = mysqli_fetch_field($result))
   {
      echo "$field->name<br>\n";
   }
   
   
   // output the records
   echo "<h3>Records in the $table table</h3>";
   echo "------------------<br>";
   while ($row = mysqli_fetch_assoc($result))
   {
      foreach ($row as $col=>$val)
      {
         echo "$col - $val<br>\n";
      }
      echo "------------------<br>";
   }
}
?>

        <footer>
                <hr>
                <a id="back" href="..">Back</a>
                <a id="back" href="viewSources.php">View Sources</a>
        </footer>
</body>
</html>


