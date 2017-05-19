<?php
//Could make this better by using classes
function writeFile($filename, $fname, $lname, $phone, $phoneType,
		$street1, $street2, $city, $state, $zip, $notes) {
	$out = fopen($filename, "w");

	fwrite($out, $fname . "\n");
	fwrite($out, $lname . "\n");
	fwrite($out, $phone . "\n");
	fwrite($out, $phoneType . "\n");
	fwrite($out, $street1 . "\n");
	fwrite($out, $street2 . "\n");
	fwrite($out, $city . "\n");
	fwrite($out, $state . "\n");
	fwrite($out, $zip . "\n");
	fwrite($out, $notes . "\n");
}

function readFileContents($filename, &$fname, &$lname, &$phone,
		&$phoneType, &$street1, &$street2, &$city,
		&$state, &$zip, &$notes) {
	$in = fopen($filename, "r");

	$fname = chop(fgets($in));
	$lname = chop(fgets($in));
	$phone = chop(fgets($in));
	$phoneType = chop(fgets($in));
	$street1 = chop(fgets($in));
	$street2 = chop(fgets($in));
	$city = chop(fgets($in));
	$state = chop(fgets($in));
	$zip = chop(fgets($in));
	$notes = chop(fread($in, filesize($filename)));
}

function parseFilename($filename, &$fname, &$lname) {
	$fname = strtok($filename, "_");
	$lname = strtok(".");
}
?>


