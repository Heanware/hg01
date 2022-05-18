<?php 
class Model_Feedback extends Model{
	function getFeedback($connection, $login, $feedback_post, $review)
	{
		$feedback = mysqli_query($connection, "INSERT INTO `feedback`(`login`, `text`, `rate`) VALUES ('$login','$feedback_post', '$review')");
	}
}
