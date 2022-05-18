<div class="transfer">
	<div class="users-transfer">
		<div class="user">
			<span>From: <?php echo $data['login'] ?></span>
			<span>Balance: <?php echo $data['balance'] ?>руб</span>
			<form action="/payment/transfer/<?php echo $data['user']?>" method="POST">
				How much: <input type="text" name="count"><input type="submit" value="Transfer">
			</form>
		</div>
		<div class="user">
			<span>To: <?php echo $data['user'] ?></span>
		</div>
	</div>
</div>