<?php 
class Model_PostAdding extends Model{
	function addPost($connection, $postTitle, $postDescription, $postText, $postImage, $author){
		$addPost = mysqli_query($connection, "INSERT INTO `posts` (`title`, `description`, `text`, `image`, `author`) VALUES ('$postTitle', '$postDescription', '$postText', '$postImage', '$author')");
	}
}