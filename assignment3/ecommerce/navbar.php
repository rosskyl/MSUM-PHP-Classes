<php?
//function insertNavBar($pathToHome) {
$pathToHome = ".."
echo <<< NAVBARID
<link rel="stylesheet" href="navbar.css">

<div id="navbar">
	<ul>
		<li><a href="$pathToHome" target="_top">Home</a></li>
		<li class="dropdown">
			<a href="javascript:void(0)" class="dropbtn">Assignments</a>
			<div class="dropdown-content">
				<a href="$pathToHome/assignment1">Assignment 1</a>
			</div>
		</li>
		<li><a href="$pathToHome/examples/" target="_top">Examples</a></li>
	</ul>
</div>
NAVBARID;
//}
?>