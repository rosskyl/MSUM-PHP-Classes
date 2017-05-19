<html>
<head>
        <title>Dump Database</title>
</head>
<body>
<form>

<?php
extract($_REQUEST);
require "sqlCredentials.php";

if ($button==NULL or $button=="select new database")
{
   echo "<h2>Select Database: ";
   $databases = getDatabases($username,$password);
   selectArray("dbname",$databases);
   echo <<< HERE
      <input type="submit" name="button" value="go">
      </h2>
HERE;
}
else
{
   $conn = mysqli_connect("localhost",$username,$password,$dbname);
   $sql = "SELECT table_name FROM information_schema.tables where table_schema='$dbname';";
   $result = mysqli_query($conn, $sql);

   echo <<< HERE
      <h2>Database: $dbname</h2>
      <h2>View Tables: 
HERE;

   while ($row = mysqli_fetch_assoc($result))
       echo "<input type='submit' name='button' value='" . $row["table_name"] . "'>\n";


   echo <<< HERE
      </h2>
      <h2>Other: 
      <input type="submit" name="button" value="clear">
      <input type="submit" name="button" value="select new database">
      </h2>
HERE;

   if ($button != "go" and $button != "clear")
   {
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
   echo <<< HERE
      <input type="hidden" name="dbname" value="$dbname">
HERE;
}
?>

<?php
function selectArray($name,$theArray)
{
   echo "<select name=\"$name\">";
   for ($i=0; $i<count($theArray); $i++)
      echo "<option>$theArray[$i]</option>";
   echo "</select>";
}

function getDatabases($username,$password)
{
   $conn  = mysqli_connect('localhost', $username , $password);
   $query = "show databases;";
   $result = mysqli_query($conn,$query);

   $result = mysqli_query($conn,$query);
   $databases;
   while ($row = mysqli_fetch_assoc($result))
       $databases[] = $row['Database'];
   mysqli_close($conn);
   return $databases;
}

?>
</form>
</body>
</html>

