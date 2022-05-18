<?php 
class Model_Blog extends Model
{
	function getSinglePost($connection, $postId){
		$count = mysqli_query($connection, "UPDATE `posts` SET `views` = `views` + 1 WHERE `id` = '$postId'");
		$currentPost = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `posts` WHERE `id` = '$postId'"));
		return $currentPost;
	}
}