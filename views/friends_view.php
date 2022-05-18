<div class="friends">
	<h1 style="text-align: center;">FRIENDS</h1>
	<?php 
	foreach ($data['request'] as $request){ 
		?>
		<?php if ($request['status'] == 'waiting' && $request['count'] == 0){ 
			?>
			<div class="friend">
				<div class="avatar" style="background-image: url('/Templates/users_avatars/<?php echo $request['image'] ?>')">
					<div class="status" style="background-color: green;"></div>
				</div>
				<div class="currently">
					<div class="nickname"><a href="/cabinet/user/<?php echo $request['sender'] ?>"><?php echo $request['sender'] ?></a></div>
					<div class="doing">Asks for friendship </div>
					<div class="actions">
						<a href="/friends/accept/<?php echo $request['sender'] ?>"><span>Accept request</span></a>
						<a href="/friends/ignore/<?php echo $request['sender'] ?>"><span>Ignore request</span></a>
						<a href="/friends/cancel/<?php echo $request['sender'] ?>"><span>Cancel request</span></a>
					</div>
				</div>
			</div>
		<?php }else{

		}
	}?>

	<?php foreach ($data['friendsInfo'] as $friend) {
		?>
		<div class="friend">
			<div class="avatar" style="background-image: url('/Templates/users_avatars/<?php echo $friend['image'] ?>')">
				<div class="status" style="background-color: green;"></div>
			</div>
			<div class="currently">
				<div class="nickname">
					<a href="/cabinet/user/<?php echo $friend['login']?>"><?php echo $friend['login'] ?></a>
				</div>
				<div class="doing">Fighting fellows</div>
				<div class="actions">
					<a href="/payment/transfer/<?php echo $friend['login']?>"><span>Transfer</span></a>
					<a href="/payment/request/<?php echo $friend['login'] ?>"><span>Request money</span></a>
					<a href="/"><span>Invite to game</span></a>
				</div>
			</div>
			<div class="friend-delete">
				<a href="/friends/delete/<?php echo $friend['login']?>" style="display: block;">
					<i class="far fa-window-close fa-3x"></i>
				</a>
			</div>
		</div>
	<?php } ?>
</div>