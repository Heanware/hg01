<?php 
class Model_UserLogin extends Model{
	function getUser($connection, $userLogin, $userPassword){
		$user = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `users` WHERE `login` = '$userLogin' AND `password` = '$userPassword'"));
		if($user['login'] == $userLogin AND $user['password'] == $userPassword){
			return $user;
		}else{
			return false;
		}
	}
}