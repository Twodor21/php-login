<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head lang="en" dir="ltr">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Log In</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<nav>
		<ul class="home">
			<li><a href="index.php">Home </a></li>
		</ul>
		<ul class="menu">
			<?php
				if(isset($_SESSION["useruid"])){
					echo "<li><a href='php/includes/logout.inc.php'> Log Out </a></li>";
					if($_SESSION["rank"] == "admin"){
						echo "<li><a href='users.php'> Members </a></li>";
					}
				} 
				else {
					echo "<li><a href='login.php'> Log In </a></li>";
					echo "<li><a href='signup.php'> Sign up </a></li>";
				}
			?>
			<li><a href="index.php"> About us </a></li>
		</ul>
	</nav> 
	<div class="wrapper">
