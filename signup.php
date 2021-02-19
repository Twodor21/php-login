<?php
	include_once 'php/header.php';
?>

		<section class="signup-form">
			<div class="signform">
				<h2>Sign up</h2>
				<form action="php/includes/signup.inc.php" method="post">
					<input type="text" name="name" placeholder="Full name..." value="<?php echo htmlspecialchars($_SESSION["nm"] ?? ''); ?>">
					<input type="text" name="email" placeholder="Email..." value="<?php echo htmlspecialchars($_SESSION["em"] ?? ''); ?>">
					<input type="text" name="uid" placeholder="Username..." value="<?php echo htmlspecialchars($_SESSION["usrid"] ?? ''); ?>">
					<input type="password" name="pwd" placeholder="password...">
					<input type="password" name="pwdrepeat" placeholder="Confirm password...">
					<button type="submit" name="submit">Sign Up</button>
				</form>
			</div>
			<?php
				if(isset($_GET["error"]) ) {
					if ($_GET["error"] == "emptyinput") {
						echo "<p>Fill in all fields!</p>";
					} else if($_GET["error"] == "invalidname") {
						echo "<p>The name should not contain symbols or letters!</p>";
					} else if($_GET["error"] == "DBerror") {
						echo "<p>The DB cannot be accessed!</p>";
					}
					else if($_GET["error"] == "invaliduid") {
						echo "<p>Choose a proper username!</p>";
					}
					else if($_GET["error"] == "invalidemail") {
						echo "<p>Choose a proper E-mail!</p>";
					}
					else if($_GET["error"] == "passwordsdontmatch") {
						echo "<p>Passwords Don't match!</p>";
					}
					else if($_GET["error"] == "stmtfailed") {
						echo "<p>Something went wrong, try again!</p>";
					}
					else if($_GET["error"] == "usernametaken") {
						echo "<p>Username or E-mail already taken!</p>";
					}
					else if($_GET["error"] == "none") {
						echo "<p>You are signed up!</p>";
					}
				}
			?>
		</section>
	
<?php
	include_once 'php/footer.php';
?>