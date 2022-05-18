<div class="gamesRequests vh">
	<h3>Create your own game with arbitrary bet</h3>
	<form action="/gameroachlobby" class="createReq" method="POST">
		<button type="submit" class="betbutton" value="100" name="bet">100</button>
		<button type="submit" class="betbutton" value="200" name="bet">200</button>
		<button type="submit" class="betbutton" value="300" name="bet">300</button>
		<button type="submit" class="betbutton" value="400" name="bet">400</button>
		<button type="submit" class="betbutton" value="500" name="bet">500</button>
		<!--<input type="submit">-->
	</form>
	<div class="gameReqTop">
		<div>Id</div>
		<div>Time</div>
		<div>Login</div>
		<span class="bet">Bet</span>
		<div></div>
	</div>
	<?php foreach ($data['requests'] as $request){ ?>
		<div class="gameReq">
			<div><?php echo $request['id'] ?></div>
			<div><?php echo $request['time'] ?></div>
			<div><?php echo $request['login'] ?></div>
			<span class="bet"><?php echo $request['bet'] ?></span>
			<a href="/gameroach/findgame/<?php echo $request['id'] ?>" class="join">Join</a>
		</div>
	<?php } ?>
</div>
