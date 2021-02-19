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

		
	
<?php
	include_once 'php/footer.php';
?>