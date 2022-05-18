<?php 
if($currentPost == 0 ){
	echo "not found";
}else{ 
	?> 
	<div class="post-body">
		<a href="/">на главную</a>
		<div class="post-title">		
			<h1><?php echo $currentPost['title'] ?></h1>
		</div>
		<div class="post-description">
			<?php echo $currentPost['description'] ?>
		</div>
		<div class="post-image">
			<img src="/Templates/img/<?php echo $currentPost['image'] ?>" alt="post image">
		</div>
		<div class="post-text">
			<?php echo $currentPost['text'] ?>
		</div>
	</div>
	<?php
}
?>
