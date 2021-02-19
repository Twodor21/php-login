<?php
	include_once 'php/header.php';
?>

		<section class="index-intro"> 

			<?php
					if(isset($_SESSION["userN"])){
						echo "<div id='welc'>Hello there ". $_SESSION["userN"] . "! </div>";
					}
			?>			
		</section>
	
	<div class="home1">
		<h1>Hello everyone,</h1><br />
		<h3>This website is made just to test the Login system<br /> and the Data transfered through the Database.</h3>
	</div>
<?php
	include_once 'php/footer.php';
?>