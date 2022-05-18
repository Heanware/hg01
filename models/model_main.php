<?php 

class Model_Main extends Model
{
	function getBestPlayers($connection){
		$players = mysqli_query($connection, "SELECT * FROM `users` ORDER BY `balance` DESC LIMIT 6");
		$bestplayers = [];
		while($player = mysqli_fetch_assoc($players)){
			$bestplayers[] = $player;
		};
		return $bestplayers;
	}
}
