	<div class="cabinet">
		<div class="cabinet-avatar">

			<?php if(isset($data['avatar_redact']) == true){ ?>
				<form enctype="multipart/form-data" method="POST"> 
					<input name="userImg" type="file">
					<input type="submit" value="Upload">
				</form>
			<?php } ?>
			<div class="cabinet-avatar-image" style="background-image: url('/Templates/users_avatars/<?php echo $data['image'] ?>');">
				<?php if($data['user'] == true){ ?>
					<a class = "avatar-redact-form" href="/cabinet/imageredact">
						<?php if($data['theme'] == 'dark'){ ?>
							<i class="fa white fa-pencil-square-o" aria-hidden="true"></i>
						<?php }if($data['theme'] == 'light'){ ?>
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
						<?php } ?>
					</a>
				<?php } ?>
			</div>
			<span>Login: <?php echo $data['login']; ?></span>
			<div class="action">
				<?php if ($data['balance'] != null) { ?>
					<a href="">Balance: <?php echo $data['balance'] ?></a>
				<?php }else{ ?>
				<?php } ?>
				<?php if ($data['user'] == true){ ?>
					<a href="https://hg.01company.ru/balance">Add money</a>
					<a href="">Withdraw</a>
				<?php }?>
				<?php
				if($data['user'] == true){?>
				<?php }else if($data['friendRequest'] == null){ ?>
					<a href="/friends/add/<?php echo $data['login'] ?>">Add friend</a>
				<?php }else if($data['friendRequest'] == 'waiting'){?>
					Friend request sent
				<?php }else if($data['friendRequest'] == 'ignored'){ ?>
					Friend request ignored
				<?php }else if($data['friendRequest'] == 'accepted'){?>
					Your friend already
					<span onclick="openwindow('chatId')">Chat</span>
				<?php } ?>

			</div>
		</div>
		<?php if(isset($data['redact']) == true){ ?>
			<div class="cabinet-info-redact">
				<form class="userredact-form" action="/cabinet/userredact" method="POST">
					<h3>Name</h3>
					<input type="text" name="name" placeholder="<?php echo $data['name'] ?>" value="<?php echo $data['name'] ?>" pattern="^[A-Za-zА-Яа-яЁё]+$">
					<h3>Surname</h3>
					<input type="text" name="surname" placeholder="<?php echo $data['surname'] ?>"  value="<?php echo $data['surname'] ?>" pattern="^[A-Za-zА-Яа-яЁё]+$">
					<h3>Email</h3>
					<input type="email" name="email" placeholder="<?php echo $data['email'] ?>"  value="<?php echo $data['email'] ?>" pattern="([A-z0-9_.-]{1,})@([A-z0-9_.-]{1,}).([A-z]{2,8})">
					<h3>Phone</h3>
					<input type="text" name="number" maxlength='15' placeholder="+7(___)___-__-__" value="<?php echo $data['number'] ?>" pattern="[0-9]{11}" >
					<input type="submit" value="Save">
				</form>
			</div>
		<?php }else{ ?>
			<div class="cabinet-info">
				<h3>Name</h3>
				<span><?php echo $data['name'] ?></span>
				<h3>Surname</h3>
				<span><?php echo $data['surname'] ?></span>
				<h3>Email</h3>
				<a href="mailto:<?php echo $data['email'] ?>"><?php echo $data['email'] ?></a>
				<h3>Phone</h3>
				<span>
					<a href="tel:<?php echo $data['number'] ?>"><?php echo $data['number'] ?></a>
				</span>
				<?php if($data['user'] == true){ ?>
					<a href="/cabinet/userredact" id="cabinet-redact">Redact</a>
				<?php } ?>
			</div>
		<?php } ?>		
	</div>
	<?php if (count($request) != 0) {	?>
		<h1 style="font-family: 'Comfortaa'; text-align: center;">MONEY REQUESTS</h1>
		<?php $i = 0;
			foreach ($request as $moneyRequest) { ?>
			<?php if ($moneyRequest['status'] == 'waiting' && $moneyRequest['sender'] != $data['login']){ ?>
				<div class="request">
					<div class="friend">
						<div class="avatar" style="background-image: url('/Templates/users_avatars/<?php echo $data['request_avatar'][$i]; $i += 1; #сука наконец-то этот ебучий $i вывелся?>');">
							<div class="status" style="background-color: green;"></div>
						</div>
						<div class="currently">
							<div class="nickname"><a href="/cabinet/user/<?php echo $moneyRequest['sender'] ?>"><?php echo $moneyRequest['sender'] ?></a></div>
							<div class="doing">Asking money: <?php echo $moneyRequest['count'] ?>rub.</div>
							<div class="actions">
								<a href="/payment/acceptMoneyRequest/<?php echo $moneyRequest['sender'] ?>"><span>Accept request</span></a>
								<a href="/payment/ignoreMoneyRequest/<?php echo $moneyRequest['sender'] ?>"><span>Ignore request</span></a>
								<a href="/payment/cancelMoneyRequest/<?php echo $moneyRequest['sender'] ?>"><span>Cancel request</span></a>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		<?php } } ?>

