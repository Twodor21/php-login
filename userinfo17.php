<?php include_once 'php/header.php'; ?> 
				<div class='users'>
				<h1 class='title'>Users info:</h1>
				<?php

				require_once 'php/includes/dbh.inc.php';
				require_once 'php/includes/functions.inc.php';

				$arr = showMembers($conn);

				for($i=0; $i< count($arr);$i++){

					if($arr[$i]['usersId'] == 17){
						echo "<div class='users1'>". $arr[$i]['usersName']."
								<p>E-mail:". $arr[$i]['usersEmail']."</p>
								<p>UserName: ". $arr[$i]['usersUid']."</p>
								<p>Rank: ". $arr[$i]['rank']."</p>";
								$_SESSION['rankid'] = $arr[$i]['usersId'];
								$_SESSION['rankstatus'] = $arr[$i]['rank'];
								echo "<form action='php/includes/upgrade.php' method='post'><button type='submit' name='upgrade'>Upgrade/downgrade rank</button></form>";

								echo "</div>" ;
						
					}
				}
				?> 
</div>

<?php include_once 'php/footer.php'; ?>