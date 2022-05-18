<div class="board-info games-info">
	<a class="board-category" href="/">
		<span>
			ALL GAMES
		</span>
	</a>
	<a class="board-category" href="/">
		<div>
			POPULAR
		</div>
	</a>
	<?php if($data['login'] != null){ ?>
		<a class="board-category" href="/">
			<div>
				MY GAMES
			</div>
		</a>
		<a class="board-category" href="/payment/history">
			<div>
				HISTORY
			</div>
		</a>
		<a class="board-category" href="/friends">
			<div>
				FRIENDS
			</div>
		</a>
	<?php } ?>
</div>
<div class="board-games">
	<?php if($data['status'] == 'banned'){ ?>'
	YOU CANT PLAY UNTIL YOU GET UNBANNED <br>
	USE FEEDBACK TO SOLVE THIS
<?php }else{ ?>
	<a class="board-game" href="/gameroachlobby">ROACH<div class="board-game-bg" style="background-image: url('/Templates/img/roachbg.jpg');"></div></a>
	<a class="board-game" href="/">SOON...<div class="board-game-bg"></div></a>
	<a class="board-game" href="/">SOON...<div class="board-game-bg"></div></a>
	<a class="board-game" href="/">SOON...<div class="board-game-bg"></div></a>
	<a class="board-game" href="/">SOON...<div class="board-game-bg"></div></a>
	<a class="board-game" href="/">SOON...<div class="board-game-bg"></div></a>
<?php } ?>
</div>		
<h1 class="bestplayers">Best players</h1>
<div class="best-players">
	<?php foreach ($data['best'] as $bestPlayer) { ?>
		<div class="best-player">
			<a href="http://hg.01company.ru/cabinet/user/<?php echo $bestPlayer['login'] ?>">
				<div class="player" style="background-image: url('/Templates/users_avatars/<?php if(isset($data['best'])){ echo $bestPlayer['image']; };?>');"><span class="nick"><?php echo $bestPlayer['login']?></span></div>
			</a>
		</div>
	<?php } ?>
</div>
