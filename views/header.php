<div class="links">
	<?php if($data['theme'] == 'light'){ ?>
		<a href="/"><div class="logo" style="background-image: url('/Templates/img/logolightblackhole.gif');">MAIN</div></a>
	<?php }else{ ?>
		<a href="/"><div class="logo" style="background-image: url('/Templates/img/logoblackhole.gif');">MAIN</div></a>	
	<?php } ?>
	<?php if($data['status'] != ''){?>
		<div class="links-wrapper">
			<div class="hamburger-menu" style="position: absolute;">
				<input id="menu__toggle" type="checkbox" />
				<label class="menu__btn" for="menu__toggle">
					<span></span>
				</label>  <ul class="menu__box">
					<li><a class="menu__item" href="/cabinet">Profile</a></li>
					<?php if ($data['status'] == 'admin' | $data['status'] == 'superadmin'){ ?>
						<li><a class="menu__item" href="/admin">Admin panel</a></li>
					<?php } ?>
					<li><a class="menu__item" href="/balance">Add balance</a></li>
					<li><a class="menu__item" href="/withdraw">Withdraw</a></li>
					<li><a class="menu__item" href="/feedback">Feedback</a></li>
					<li><a class="menu__item" href="/logout">Logout  <i class="fa fa-sign-out"></i></a></li>
				</ul>
			</div>
			<nav>
				<ul class="topmenu">
					<li>
						<a href="/feedback" class="down">
							<i class="fa fa-comment white fa-1x"></i>
						</a>
						<ul class="submenu">
							<li><a href="/feedback">Feedback</a></li>
						</ul>
					</li>
				</ul>
			</nav>
			<nav>
				<ul class="topmenu">
					<li>
						<a href="/cabinet" class="down">
							<i class="fa fa-user white fa-1x"></i>
						</a>
						<ul class="submenu">
							<li><a href="/cabinet">Profile</a></li>
							<?php if ($data['status'] == 'admin' | $data['status'] == 'superadmin'){ ?>
								<li><a href="/admin">Admin panel</a></li>
							<?php } ?>
							<li><a href="/balance">Add balance</a></li>
							<li><a href="/withdraw">Withdraw</a></li>
							<li><a href="/logout">Logout  <i class="fa fa-sign-out"></i></a></li>
						</ul>
					</li>
				</ul>
			</nav>
			<?php if($data['theme'] == 'dark'){ ?>
				<a class="toggle-theme" href="/cabinet/light"><i class="fa fa-toggle-on"></i></a>
			<?php }else{ ?>
				<a class="toggle-theme" href="/cabinet/dark"><i class="fa fa-toggle-off"></i></a>
			<?php } ?>
		</div>
	<?php }else{ ?>
		<a href="userlogin">Sign in</a>
		<a href="useradding">Sign up</a>
		<?php if($data['theme'] == 'dark'){ ?>
			<a href="/cabinet/light"><i class="fa fa-toggle-on"></i></a>
		<?php }else{ ?>
			<a href="/cabinet/dark"><i class="fa fa-toggle-off"></i></a>
		<?php } ?>
	<?php } ?>
</div>






