<?php 
class Model_GameRoach{
	function createRequest($connection, $id){
		$info = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `gameroach_games` WHERE `id` = '$id'"));
		$player1 = $info['player1'];
		$player2 = $info['player2'];
		$bet = $info['bet'];
		if($player1 != ''){
			mysqli_query($connection, "INSERT INTO `gameroach_games` (`player1`, `player2`, `bet`) VALUES ('$player1', '$player2', '$bet')");
		}
		$id = mysqli_insert_id($connection);
		return $id;
	}
	function createGame($connection, $login, $id){
		$bet = mysqli_fetch_assoc(mysqli_query($connection, "SELECT `bet` FROM `gameroach_requests` WHERE `login` = '$login'"))['bet'];
		if($id != ''){
			$game = mysqli_query($connection, "INSERT INTO `gameroach_games` (`id`, `player1`, `bet`) VALUES ('$id', '$login', '$bet')");
		}
	}
	function updateGame($connection, $login, $id){
		$check = mysqli_fetch_assoc(mysqli_query($connection, "SELECT `player2` FROM `gameroach_games` WHERE `id` = '$id'"))['player2'];
		if($check == '0'){
			mysqli_query($connection, "UPDATE `gameroach_games` SET `player2` = '$login' WHERE `id` = '$id'");
			mysqli_query($connection, "DELETE FROM `gameroach_requests` WHERE `id` = '$id'");
		}
	}
/*	function deleteRequest($connection)*/
	function setWinners($connection, $winner, $id){
		$player1 = mysqli_fetch_assoc(mysqli_query($connection, "SELECT `player1` FROM `gameroach_games` WHERE `id` = '$id'"))['player1'];
		$player2 = mysqli_fetch_assoc(mysqli_query($connection, "SELECT `player2` FROM `gameroach_games` WHERE `id` = '$id'"))['player2'];
		$bet = mysqli_fetch_assoc(mysqli_query($connection, "SELECT `bet` FROM `gameroach_games` WHERE `id` = '$id'"))['bet'];
		if($winner == 'left'){
			mysqli_query($connection, "UPDATE `gameroach_games` SET `player1_status` = '1', `player2_status` = '0' WHERE `id` = '$id'");
			mysqli_query($connection, "UPDATE `users` SET `balance` = `balance` + '$bet' WHERE `login` = '$player1'");
			mysqli_query($connection, "UPDATE `users` SET `balance` = `balance` - '$bet' WHERE `login` = '$player2'");
		}else if($winner == 'right'){
			mysqli_query($connection, "UPDATE `gameroach_games` SET `player1_status` = '0', `player2_status` = '1' WHERE `id` = '$id'");
			mysqli_query($connection, "UPDATE `users` SET `balance` = `balance` - '$bet' WHERE `login` = '$player1'");
			mysqli_query($connection, "UPDATE `users` SET `balance` = `balance` + '$bet' WHERE `login` = '$player2'");
		}
	}
}