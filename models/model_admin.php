<?php 
class Model_Admin extends Model{	
	function getAllUsers($connection){
		$allUsers = mysqli_query($connection, "SELECT * FROM `users`");
		$users = [];
		while($user = mysqli_fetch_assoc($allUsers)){
			$users[] = $user;
		}
		return $users;
	}
	function getAllFeedback($connection){
		$allFeedback = mysqli_query($connection, "SELECT * FROM `feedback`");
		$allFeed = [];
		while($feedback = mysqli_fetch_assoc($allFeedback)){
			$allFeed[] = $feedback;
		};
		return $allFeed;
	}
	function changeUserStatus($connection, $status, $userId){
		$changeStatus = mysqli_query($connection, "UPDATE `users` SET `status` = '$status' WHERE `id` = '$userId'");
	}
	function deleteFeedbackPost($connection, $id){
		$deleteFeedback = mysqli_query($connection, "DELETE FROM `feedback` WHERE `feedback`.`id` = '$id'");
	}
}
