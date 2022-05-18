<?php 
class Model_Cabinet extends Model{
	function getUser($connection, $nickname){
		$user = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `users` WHERE `login` = '$nickname'"));
		return $user;
	}
	function getRequest($connection, $login, $user){
		$request = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `friends_requests` WHERE `sender` = '$login' AND `taker` = '$user' OR `sender` = '$user' AND `taker` = '$login'"));
		return $request['status'];
	}
	function getMoneyRequest($connection, $login){
		$requests = mysqli_query($connection, "SELECT * FROM `friends_requests` WHERE `count` != 0 AND `taker` = '$login' AND `status` != 'accepted' ");
		$request = [];
		while($moneyRequest = mysqli_fetch_assoc($requests)) {
			$request[] = $moneyRequest;
		}
		return $request;
	}
	function getMoneyRequestAvatar($connection, $request_ava){
		$request = mysqli_query($connection, "SELECT `image` FROM `users` WHERE `login` = '$request_ava' ");
		$request_image = [];
		while($request_ava = mysqli_fetch_assoc($request)){
			$request_image[] = $request_ava;
		}
		return $request_image;
	}
	function redactInfo($connection, $infoRedact){
		$name = $infoRedact['name'];
		$surname = $infoRedact['surname'];
		$email = $infoRedact['email'];
		$number = $infoRedact['number'];
		$login = $infoRedact['login'];
		$redact = mysqli_query($connection, "UPDATE `users` SET `name` = '$name', `surname` = '$surname', `email` = '$email', `number` = '$number' WHERE `login` = '$login'");
	}
	function deleteOldAvatar($connection, $login){
		$old_avatar = mysqli_fetch_assoc($connection, "SELECT `image` FROM `users` WHERE `login` = '$login'");
		return $old_avatar;
	}
	function updateAvatar($connection, $userImg, $login){
		$addNewAvatar = mysqli_query($connection, "UPDATE `users` SET `image` = '$userImg' WHERE `login` = '$login'");
	}

}	