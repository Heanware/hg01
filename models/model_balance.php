<?php 
class Model_Balance extends Model{
	function checkProcessedNotification($connection, $id){
		$notification = mysqli_query($connection, "SELECT * FROM `qiwi_notifications` WHERE `bill_id` = '$id'");
		if(mysqli_num_rows($notification) == 0){
			return false;
		}else{
			return true;
		}
	}
	function addMoney($connection, $login, $sum, $id){
		mysqli_query($connection, "INSERT INTO `qiwi_notifications` (`bill_id`) VALUES ('$id')");
		mysqli_query($connection, "UPDATE `users` SET `balance` = `balance` + '$sum' WHERE `login` = '$login'");
	}
}
