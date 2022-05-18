<?php 
class Model_Friends extends Model{
	function action_index(){
		
	}
	function createRequest($connection, $sender, $taker){
		mysqli_query($connection, "INSERT INTO `friends_requests`(`sender`, `taker`, `status`) VALUES ('$sender', '$taker', 'waiting')");
	}
	function createFriend($connection, $sender, $taker){
		mysqli_query($connection, "INSERT INTO `friends`(`first_friend`, `second_friend`) VALUES ('$sender', '$taker')");
		mysqli_query($connection, "UPDATE `friends_requests` SET `status` = 'accepted' WHERE `sender` = '$taker' AND `taker` = '$sender' AND `count` = '0'");
	}
	function ignoreFriend($connection, $sender, $taker){
		mysqli_query($connection, "UPDATE `friends_requests` SET `status` = 'ignored' WHERE `sender` = '$taker' AND `taker` = '$sender' AND `count` = '0'");
	}
	function cancelFriend($connection, $sender, $taker){
		mysqli_query($connection, "UPDATE `friends_requests` SET `status` = 'cancel' WHERE `sender` = '$taker' AND `taker` = '$sender' AND `count` = '0'");
	}
	function deleteFriend($connection, $sender, $taker){
		mysqli_query($connection, "DELETE FROM `friends` WHERE `first_friend` = '$sender' AND `second_friend` = '$taker' OR `first_friend` = '$taker' AND `second_friend` = '$sender' ");
		mysqli_query($connection, "DELETE FROM `friends_requests` WHERE `sender` = '$sender' AND `taker` = '$taker' OR `sender` = '$taker' AND `taker` = '$sender' ");
	}
	function getRequest($connection, $login){
		$requests = mysqli_query($connection, "SELECT * FROM `friends_requests` WHERE `taker` = '$login'");
		$allRequests = [];
		while($request = mysqli_fetch_assoc($requests)){
			$sender = $request['sender'];
			$requestsImage = mysqli_fetch_assoc(mysqli_query($connection, "SELECT `image` FROM `users` WHERE `login` = '$sender'"))['image'];
			$request['image'] = $requestsImage;
			$allRequests[] = $request;
		};
		return $allRequests;
	}
	function getFriends($connection, $login){
		$allFriends = mysqli_query($connection, "SELECT * FROM `friends` WHERE `first_friend` = '$login' OR `second_friend` = '$login'");

		$friends = [];
		while($friend = mysqli_fetch_assoc($allFriends)){
			$friends[] = $friend;
		};
		$friendsInfo = [];
		foreach ($friends as $friend) {
			if ($friend['first_friend'] == $login) {
				$friend1 = $friend['second_friend'];
				$friendInfo = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `users` WHERE `login` = '$friend1'"));
				$friendsInfo[] = $friendInfo;
			}else if($friend['second_friend'] == $login){
				$friend1 = $friend['first_friend'];
				$friendInfo = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `users` WHERE `login` = '$friend1'"));
				$friendsInfo[] = $friendInfo;
			}
		}
		return $friendsInfo;
	}
}