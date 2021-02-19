<?php include_once 'php/header.php'; ?> 
				<div class='users'>
				<h1 class='title'>Users info:</h1>
				<?php

				require_once 'php/includes/dbh.inc.php';
				require_once 'php/includes/functions.inc.php';

				$arr = showMembers($conn);

				for($i=0; $i< count($arr);$i++){

					if($arr[$i]['usersId'] == 4){
						echo "<div class='users1'>". $arr[$i]['usersName']."
								<p>E-mail:". $arr[$i]['usersEmail']."</p>
								<p>UserName: ". $arr[$i]['usersUid']."</p>
								<p>Rank: ". $arr[$i]['rank']."</p>
								</div>" ;
					}
				}
				?> 
</div>
	 			<?php include_once 'php/footer.php'; ?>