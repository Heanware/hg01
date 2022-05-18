<?php 
class Model_GameRoachLobby extends Model{
	function getRequests($connection){
		$allRequests = mysqli_query($connection, "SELECT * FROM `gameroach_requests`");
		$gamesRequests = [];
		while($request = mysqli_fetch_assoc($allRequests)){
			$gamesRequests[] = $request;
		}
		return $gamesRequests;
	}
	function createRequest($connection, $bet, $login){
		$date = date("H:i:s");
		$id = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `gameroach_games` ORDER BY `id` DESC LIMIT 1"))['id'] + 1;
		mysqli_query($connection, "INSERT INTO `gameroach_requests` (`id`, `login`, `time`, `bet`) VALUES ('$id', '$login', '$date', '$bet')");
		return $id;
	}
}