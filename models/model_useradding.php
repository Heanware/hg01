<?php 
class Model_UserAdding extends Model{
	function addUser($connection, $userLogin, $userPassword, $userEmail, $userImg){
		$addUser = mysqli_query($connection, "INSERT INTO `users` (`login`, `password`, `email`, `image`, `status`) VALUES ('$userLogin', '$userPassword', '$userEmail', '$userImg', 'user')");
	}
}