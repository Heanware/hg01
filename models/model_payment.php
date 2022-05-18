<?php 
class Model_Payment extends Model{
	function transfer($connection, $login, $user, $count){
		mysqli_query($connection, "UPDATE `users` SET `balance` = `balance` + '$count' WHERE `login` = '$user'");
		mysqli_query($connection, "UPDATE `users` SET `balance` = `balance` - '$count' WHERE `login` = '$login'");
		mysqli_query($connection, "INSERT INTO `users_history` (`operation`, `status`, `count`, `user_in`, `user_out`) VALUES ('transfer', 'succesful', '$count', '$user', '$login')");
	}
	function createRequest($connection, $sender, $taker, $count){
		mysqli_query($connection, "INSERT INTO `friends_requests`(`sender`, `taker`, `status`, `count`) VALUES ('$sender', '$taker', 'waiting', '$count')");
	}
	function getHistory($connection, $login){
		$allHistory = mysqli_query($connection, "SELECT * FROM `users_history` WHERE `user_in` = '$login' OR `user_out` = '$login'");
		$history = [];
		while($userHistory = mysqli_fetch_assoc($allHistory)){
			$history[] = $userHistory;
		}
		return $history;
	}
	function acceptMoneyRequest($connection, $sender, $taker){
		$count = mysqli_fetch_assoc(mysqli_query($connection, "SELECT `count` FROM `friends_requests` WHERE `sender` = '$sender' AND `taker` = '$taker' ORDER BY `id` DESC LIMIT 1"))['count'];
		mysqli_query($connection, "UPDATE `users` SET `balance` = `balance` - '$count' WHERE `login` = '$taker'");
		mysqli_query($connection, "UPDATE `users` SET `balance` = `balance` + '$count' WHERE `login` = '$sender'");
		mysqli_query($connection, "UPDATE `friends_requests` SET `status` = 'accepted' WHERE `sender` = '$sender' and `taker` = '$taker' AND `count` = '$count'");
		mysqli_query($connection, "INSERT INTO `users_history` (`operation`, `status`, `count`, `user_in`, `user_out`) VALUES ('money request', 'succesful', '$count', '$sender', '$taker')");
	}
	function ignoreMoneyRequest($connection, $sender, $taker){
		$count = mysqli_fetch_assoc(mysqli_query($connection, "SELECT `count` FROM `friends_requests` WHERE `sender` = '$sender' AND `taker` = '$taker' ORDER BY `id` DESC LIMIT 1"))['count'];
		mysqli_query($connection, "UPDATE `friends_requests` SET `status` = 'ignored' WHERE `sender` = '$sender' and `taker` = '$taker' AND `count` = '$count'");
		mysqli_query($connection, "INSERT INTO `users_history` (`operation`, `status`, `count`, `user_in`, `user_out`) VALUES ('money request', 'ignored', '$count', '$sender', '$taker')");
	}
	function cancelMoneyRequest($connection, $sender, $taker){
		$count = mysqli_fetch_assoc(mysqli_query($connection, "SELECT `count` FROM `friends_requests` WHERE `sender` = '$sender' AND `taker` = '$taker' ORDER BY `id` DESC LIMIT 1"))['count'];
		mysqli_query($connection, "DELETE FROM `friends_requests` WHERE `sender` = '$sender' and `taker` = '$taker' AND `count` = '$count'");
		mysqli_query($connection, "INSERT INTO `users_history` (`operation`, `status`, `count`, `user_in`, `user_out`) VALUES ('money request', 'cancelled', '$count', '$sender', '$taker')");
	}
}