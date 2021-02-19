<?php

function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) {
	$result;
	if(empty($name)|| empty($email)|| empty($username)|| empty($pwd)|| empty($pwdRepeat) ) {
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;
}

function invalidUid($username) {
	$result;
	if(!preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u", $username) ) {
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;
}
function invalidEmail($email) {
	$result;
	if(!filter_var($email, FILTER_VALIDATE_EMAIL) ) {
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;
}
function pwdMatch($pwd, $pwdRepeat) {
	$result;
	if($pwd !== $pwdRepeat) {
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;
}
function uidExists($conn, $username, $email) {
	$sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql) ) {
		header("location: ../../signup.php?error=Userexists");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "ss", $username, $email);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if($row = mysqli_fetch_assoc($resultData) ) {
		return $row;
	}
	else{
		$result = false;
		return $result;
	}
	mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $username, $pwd) {
	$sql = "INSERT INTO users (usersName, usersEmail, usersUid, rank, usersPwd) VALUES (?, ?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql) ) {
		header("location: ../../signup.php?error=stmtfailed");
		exit();
	}

	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
	$rank = "user";

	mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $username, $rank, $hashedPwd);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

	$sql2 = "SELECT usersId from users WHERE usersEmail = ? AND usersUid = ? ;";
	$stmt2 = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt2, $sql2);
	mysqli_stmt_bind_param($stmt2, "ss", $email, $username);
	mysqli_stmt_execute($stmt2);
	$res = mysqli_stmt_get_result($stmt2);
	$ids = mysqli_fetch_assoc($res);
	$id = $ids['usersId'];

	$userfile = fopen("../../userinfo".$id.".php", "w") or die("unable to open file");
	$txt = "  <?php include_once 'php/header.php'; ?> 
				<div class='users'>
				<h1 class='title'>Users info:</h1>
				<?php\n
				require_once 'php/includes/dbh.inc.php';
				require_once 'php/includes/functions.inc.php';\n
				\$arr = showMembers(\$conn);\n
				for(\$i=0; \$i< count(\$arr);\$i++){\n
					if(\$arr[\$i]['usersId'] == ". $id."){
						echo \"<div class='users1'>Name: \". \$arr[\$i]['usersName'].\"
								<p>E-mail: \". \$arr[\$i]['usersEmail'].\"</p>
								<p>UserName: \". \$arr[\$i]['usersUid'].\"</p>
								<p>Rank: \". \$arr[\$i]['rank'].\"</p>\";
								\$_SESSION['rankid'] = \$arr[\$i]['usersId'];
								\$_SESSION['rankstatus'] = \$arr[\$i]['rank'];
								echo \"<form action='php/includes/upgrade.php' method='post'><button type='submit' name='upgrade'>Upgrade/downgrade rank</button></form>\";

								echo \"</div>\" ;
					}
				}
				?> \n</div>
	 	<?php include_once 'php/footer.php'; ?>";
	fwrite($userfile, $txt);
	fclose($userfile);
	header("location: ../../signup.php?error=none");

	exit();
}

function emptyInputLogin($username, $pwd) {
	$result;
	if(empty($username) || empty($pwd) ) {
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;
}

function loginUser($conn, $username, $pwd) {
	$uidExists =  uidExists($conn, $username, $username);

	if ($uidExists === false) {
		header("location: ../../login.php?error=wronglogin");
		exit();
	}

	$pwdHashed = $uidExists["usersPwd"];
	$checkPwd = password_verify($pwd, $pwdHashed);

	if($checkPwd === false) {
		header("location: ../../login.php?error=wronglogin");
		exit();
	}
	else if($checkPwd === true) {
		session_start();
		$_SESSION["userid"] = $uidExists["usersId"]; 
		$_SESSION["useruid"] = $uidExists["usersUid"];
		$_SESSION["userN"] = $uidExists["usersName"];
		$_SESSION["rank"] = $uidExists["rank"];
		header("location: ../../index.php");
		exit();
	}
}

function showMembers($conn) {
	$sql = "SELECT * FROM users;";
	
	$result = mysqli_query($conn, $sql);

	$resultData = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $resultData;

	mysqli_stmt_close($sql);
	exit();
}
function rankchange($conn,$rstatus){
	$sql = "UPDATE users SET rank=? WHERE usersId=?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql) ) {
		header("location: ../../users.php?err=NoDBconn");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "si", $rstatus, $_SESSION['rankid']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
}
