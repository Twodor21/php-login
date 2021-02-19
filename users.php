<?php
	include_once 'php/header.php';
?>

<div class="users">
<h1 class="title">Members</h1>
<?php
require_once 'php/includes/dbh.inc.php';
require_once 'php/includes/functions.inc.php';

	$arr = showMembers($conn);

	if($_SESSION['rank'] == 'admin'){
		for($i=0; $i< count($arr);$i++){
			echo "<a href='userinfo".$arr[$i]['usersId'].".php'><div class='users1'>".$arr[$i]["usersName"]."<br />".$arr[$i]['rank']."</div></a>";
		}
	}else{
		header("location: index.php");
	}
?>
</div>

<?php
	include_once 'php/footer.php';
?>