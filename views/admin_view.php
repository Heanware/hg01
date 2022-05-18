<a href="/">на главную</a>
<?php if ($data['status'] == 'admin' || $data['status'] == 'superadmin') { ?>
	<h1 class="success" id="text">YOU ARE LOGGED IN AS <?php echo $data['login'] ?></h1>
	<div class="admin-panel-tables">
		<div class="admin-panel-users">
			<table>
				<th>USERS</th>
				<tr>
					<td>LOGIN</td>
					<td>ID</td>
					<td>STATUS</td>
					<td>ACTIONS</td>
					<td>DO IT</td>
				</tr>
				<?php foreach($users as $user){ ?>
					<tr>
						<form action="admin/changeUserStatus" method="POST">
							<td><a href="/cabinet/user/<?php echo $user['login'] ?>"><?php echo $user['login'] ?></a></td>
							<td><?php echo $user['id'] ?></td>
							<td><?php echo $user['status'] ?></td>
							<td>
								<?php if($user['status'] == 'user') { ?>
									<input type="radio" value="banned" name="status">ban this user<br>
								<?php }else if($user['status'] == 'banned'){ ?>
									<input type="radio" value="user" name="status">make this user unbanned<br>
									<?php 
								} if($user['status'] == 'user' && $user['status'] != 'banned') { ?>
									<input type="radio" value="admin" name="status">give admin permissions<br>
								<?php } if($user['status'] == 'admin' && $data['login'] != $user['login']){ ?>
									<input type="radio" value="user" name="status">take away admin permissions<br>
								<?php } ?>
							</td>	
							<td>
								<div class="inputs">
									<input type="hidden" name="id" value="<?php echo $user['id']?>">
									<input type="submit" value="CONFIRM">
								</div>
							</td>
						</form>
					</tr>
					<?php 
				} 
				?>	
			</table>
		</div>
		<div class="admin-panel-feedback">
			<table>
				<th>ALL	FEEDBACK</th>
				<tr>
					<td>ID</td>
					<td>LOGIN</td>
					<td>FEEDBACK</td>
					<td>RATE</td>
					<td>DELETE</td>
				</tr>
				<?php foreach($allFeed as $feed){ ?>
					<tr>
						<form action="admin/deleteFeedbackPost" method = "POST" >
							<td><?php echo $feed['id']; ?></td>
							<td><?php echo $feed['login']; ?></td>
							<td><?php echo strip_tags((string)$feed['text']); ?></td>
							<td><?php echo $feed['rate']; ?></td>
							<td style="text-align: center"><i class="fa fa-window-close fa-2x"><input type="submit" value="<?php echo $feed['id'] ?>" name = 'delete'></i></td>
						</form>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>
<?php }else{ ?>
	<h1 class="fail" style="color: red;">RICK ROLE!!!</h1>
	<?php } ?>