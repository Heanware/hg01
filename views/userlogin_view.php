		<div class="user-login">	
			<form action="userlogin" method="POST" id="userloginform">
				<div class="user-login-wrap">
					Login<input pattern="[A-Za-z0-9]{3,}" title="Login should only contain letters and (optional) numbers" type="text" name="userLogin">
					Password<input pattern="(?=.*[a-z]){3,}" title="Password should contain 3 symbols, including any letter(s)" type="text" name="userPass">
					<input type="submit" name="loginUser">
					<?php if ($data['ok'] == false){ ?>
						<h1>Wrong login or password!</h1>
					<?php } ?>
				</div>
			</form>
		</div>