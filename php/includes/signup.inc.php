<?php

if (isset($_POST["submit"])) {
	
	$name = $_POST["name"];
	$email = $_POST["email"];
	$username = $_POST["uid"];
	$pwd = $_POST["pwd"];
	$pwdRepeat = $_POST["pwdrepeat"];

	session_start();
	$_SESSION["nm"]= $name;
	$_SESSION["em"]= $email;
	$_SESSION["usrid"]= $username;

	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';

	if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat)!== false) {
		header("location: ../../signup.php?error=emptyinput");
		exit();
	}
	if (invalidUid($name)!== false) {
		$_SESSION["nm"] = "";
		header("location: ../../signup.php?error=invalidname");
		exit();
	}
	if (invalidUid($username)!== false) {
		$_SESSION["usrid"] = "";
		header("location: ../../signup.php?error=invaliduid");
		exit();
	}
	if (invalidEmail($email)!== false) {
		$_SESSION["em"] = "";
		header("location: ../../signup.php?error=invalidemail");
		exit();
	}
	if (pwdMatch($pwd, $pwdRepeat)!== false) {
		header("location: ../../signup.php?error=passwordsdontmatch");
		exit();
	}
	if (uidExists($conn, $username, $email)!== false) {
		header("location: ../../signup.php?error=usernametaken");
		exit();
	}

	createUser($conn, $name, $email, $username, $pwd);
}
else{
	header("location: ../../signup.php");
	exit();
}


