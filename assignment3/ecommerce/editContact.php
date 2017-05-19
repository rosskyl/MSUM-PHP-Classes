<html>
<head>
	<title>Edit Contact</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="navbarIframe.css">
	<meta name="viewport" contents="width=display-width, initial-scale=1.0">
<?php
include 'functions.php';
$filename = $_REQUEST["filename"];
readFileContents($filename, $fname, $lname, $phone,
        $phoneType, $street1, $street2, $city, $state, $zip,
        $notes);
?>

</head>

<body>
        <iframe id="navbar" src="navbar.html" scrolling="no" frameborder="0" border="0"></iframe>

	<form action="addContact.php" method="post">
	<fieldset>
	<legend>Edit Contact</legend>
	<fieldset>
		<legend>Name</legend>
		<h4>First name<input type="text" name="fname" value="<?php echo "$fname";?>"></h4>
		<h4>Last name<input type="text" name="lname" value="<?php echo "$lname";?>"></h4>
	</fieldset>
	<fieldset>
		<legend>Phone Number</legend>
		<h4>Phone number<input type="text" name="phone" value="<?php echo "$phone";?>"></h4>
		<div><input type="radio" name="phoneType" value="cell" <?php if ($phoneType=="cell") echo "checked";?> >Cell Phone</div>
		<div><input type="radio" name="phoneType" value="home" <?php if ($phoneType=="home") echo "checked";?>>Home Phone</div>
		<div><input type="radio" name="phoneType" value="other" <?php if ($phoneType=="other") echo "checked";?>>Other</div>
	</fieldset>
	<fieldset>
		<legend>Address</legend>
		<h4>Street<input type="text" name="street1" value="<?php echo "$street1";?>"></h4>
		<h4>Street<input type="text" name="street2" value="<?php echo "$street2";?>"></h4>
		<h4>City<input type="text" name="city" value="<?php echo "$city";?>"></h4>
		<h4>State<input type="text" name="state" value="<?php echo "$state";?>"></h4>
		<h4>Zip code<input type="text" name="zip" value="<?php echo "$zip";?>"></h4>
	</fieldset>
	<fieldset>
		<legend>Notes</legend>
		<textarea name="notes" rows="10" cols="50"><?php echo "$notes";?></textarea>
	</fieldset>
	<input type="submit" value="Submit">
	</fieldset>
	</form>

	<footer>
<?php
echo "<HR>";
highlight_file("editContact.php");
?>

        </footer>


</body>
</html>
