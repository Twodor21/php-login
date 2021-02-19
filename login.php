<?php
	include_once 'php/header.php';
?>

		<section class="signup-form">
			<div class="signform">
				<h2>Log In</h2>
				<form action="php/includes/login.inc.php" method="post">
					<input type="text" name="uid" placeholder="Username/Email..." value="<?php echo htmlspecialchars($_POST['uid'] ?? ''); ?>">
					<input type="password" name="pwd" placeholder="password...">
					<button type="submit" name="submit">Log In</button>
				</form>
			</div>

			<?php
				if(isset($_GET["error"]) ) {
					if ($_GET["error"] == "emptyinput") {
						echo "<p>Fill in all fields!</p>";
					} 
					else if($_GET["error"] == "wronglogin") {
						echo "<p>Incorrect login information!</p>";
					}
				}
			?>

		</section>
	
<?php
	include_once 'php/footer.php';
?>