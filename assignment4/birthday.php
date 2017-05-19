<html>
<head>
        <title>Birthday</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="../navbarIframe.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php
function isValidDate($day, $month, $year) {
	$months31 = array(1, 3, 5, 7, 8, 10, 12);
	if (in_array($month, $months31) && ($day < 1 || $day > 31))
		return False;
	elseif ($month == 2) {//february
		//check if year is leap year
		if (date("L", mktime(0, 0, 0, 1, 1, $year)) == 1) {
			if ($day < 1 || $day > 29)
				return False;
		}
		elseif ($day < 1 || $day > 28) {echo "Not leapyear";
			return False;}
	}
	elseif ($day < 1 || $day > 30) //all the other months have 30 days
		return False;
	return True;
}

function season($day, $month) {
	if ($month == 1 || $month == 2 || ($month == 3 && $day < 20) || ($month == 12 && $day >= 21))
		return "winter";
	elseif ($month == 3 || $month == 4 || $month == 5 || ($month == 6 && $day < 21))
		return "spring";
	elseif ($month == 6 || $month == 7 || ($month == 8 && $day < 22))
		return "summer";
	else
		return "fall";
}

function zodiac($day, $month) {
	if (($month == 1 && $day >= 20) || ($month == 2 && $day <= 16))
		return "Capricorn";
	elseif ($month == 2 || ($month == 3 && $day <= 11))
		return "Aquarius";
	elseif ($month == 3 || ($month == 4 && $day <= 18))
		return "Pisces";
	elseif ($month == 4 || ($month == 5 && $day <= 13))
		return "Aries";
	elseif ($month == 5 || ($month == 6 && $day <= 21))
		return "Taurus";
	elseif ($month == 6 || ($month == 7 && $day <= 20))
		return "Geminie";
	elseif ($month == 7 || ($month == 8 && $day <= 10))
		return "Cancer";
	elseif ($month == 8 || ($month == 9 && $day <= 16))
		return "Leo";
	elseif ($month == 9 || ($month == 10 && $day <= 30))
		return "Virgo";
	elseif ($month == 10 || ($month == 11 && $day <= 23))
		return "Libra";
	elseif ($month == 11 && $day <= 29)
		return "Scorpio";
	elseif ($month == 11 || ($month == 12 && $day <= 17))
		return "Ophiuchus";
	else
		return "Sagittarius";
}

function chineseAnimal($year) {
	$animals = array("Rat", "Ox", "Tiger", "Rabbit", "Dragon", "Snake", "Horse", "Goat", "Monkey", "Rooster", "Dog", "Pig");
	$index = ($year - 1900) % 12;
	return $animals[$index];
}

function age($day, $month, $year) {
	$curDay = date("d");
	$curMonth = date("m");
	$curYear = date("Y");

	$age = $curYear - $year;
	if ($month > $curMonth)
		$age -= 1;
	elseif ($month == $curMonth && $day > $curDay)
		$age -= 1;
	if ($year == date("Y"))
		$age += 1;
	return $age;
}

function birthWeekday($day, $month, $year) {
	return date("l", mktime(0, 0, 0, $month, $day, $year));
}

function nextBirthWeekday($day, $month, $year) {
	//Technically should check if the birthday is on a leap day and go to the next leap year instead
	if (age($day, $month, $year) == age(date("d"), date("m"), date("Y"))) //Birthday has passed
		return date("l", mktime(0, 0, 0, $month, $day, date("Y")+1));
	else
		return date("l", mktime(0, 0, 0, $month, $day, date("Y")));
}

function daysToNextBirthday($day, $month) {
	$bday = mktime(0, 0, 0, $month, $day, date("Y"));
	$today = getdate()[0];

	$days = floor(($bday-$today)/86400)+1;

	//I really should also check for leap years, but that gets really complicated as
	//I would have to have a case for this year is a leap year and birthday is before leap year and today is after leap year,
	//this leap year and birthday is after leap year and today after leap year, and so on
	//Since that wouldn't occur for another couple of years, I will leave it to later
	if ($days < 0)
		$days += 365;
	return $days;
}
?>

</head>
<body>
        <h1>Kyle Ross</h1>
        <h2>CSIS 311 Assignment 4</h2>
        <h3>Birthday Fun</h3>

        <iframe id="navbar" src="../navbar.html" scrolling="no" frameborder="0" border="0"></iframe>

<?php
$months = array("jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec");
$day = $_REQUEST["day"];
$month = $_REQUEST["month"];
$year = $_REQUEST["year"];

$month = array_search($month, $months) + 1;//add one because array indexes are zero based

echo "<h4>Today is " . date("l, F jS, Y") . "</h4>";

echo "<hr>";

if (!isValidDate($day, $month, $year))
	echo "<h4>Please enter a valid date</h4>";
else {
	$birthdate = mktime(0, 0, 0, $month, $day, $year);
	echo "<h4>Here is the information you requested for your birthday on " . date("F jS, Y", $birthdate) . ":</h4>";
	if (isset($_REQUEST["season"])) {
		echo "<p>Your birthday is in the " . season($day, $month) . "</p>";
	}
	if (isset($_REQUEST["zodiac"])) {
		echo "<p>Your zodiac sign is " . zodiac($day, $month) . "</p>";
	}
	if (isset($_REQUEST["chinese"])) {
		echo "<p>The chinese animal for your birthyear is " . chineseAnimal($year) . "</p>";
	}
	if (isset($_REQUEST["age"])) {
		echo "<p>You are " . age($day, $month, $year) . " years old</p>";
	}
	if (isset($_REQUEST["birthWeekday"])) {
		echo "<p>You were born on a " . birthWeekday($day, $month, $year) . "</p>";
	}
	if (isset($_REQUEST["nextBirthWeekday"])) {
		echo "<p>Your next birthday is on a " . nextBirthWeekday($day, $month, $year) . "</p>";
	}
	if (isset($_REQUEST["daysToNext"])) {
		echo "<p>There are " . daysToNextBirthday($day, $month) . " days your next birthday</p>";
	}

}

?>


        <footer>
                <p><a id="back" href="birthday.html">Back</a></p>
                <br />
<?php
echo "<HR>";
highlight_file("birthday.php");
?>

        </footer>
</body>
</html>

