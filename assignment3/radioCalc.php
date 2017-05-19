<html>
<head>
        <title>Calculator</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="../navbarIframe.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
        <h1>Kyle Ross</h1>
        <h2>CSIS 311 Assignment 3</h2>
        <h3>Radio Button Calculator</h3>

        <iframe id="navbar" src="../navbar.html" scrolling="no" frameborder="0" border="0"></iframe>

<?php
$num1 = $_REQUEST["num1"];
$num2 = $_REQUEST["num2"];
$op = $_REQUEST["op"];

if ($op == "+")
	$result = $num1 + $num2;
elseif ($op == "-")
	$result = $num1 - $num2;
elseif ($op == "*")
	$result = $num1 * $num2;
elseif ($op == "/")
	$result = $num1 / $num2;
elseif ($op == "%")
	$result = $num1 % $num2;

echo "<p>";
echo "$num1 $op $num2 = $result";
echo "</p>";
?>


        <footer>
                <p><a id = "back" href="radioCalc.html">Back</a></p>
                <br />
<?php
echo "<HR>";
highlight_file("radioCalc.php");
?>

        </footer>
</body>
</html>


