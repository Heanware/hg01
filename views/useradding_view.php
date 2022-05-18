<div class="user-login">
	<form action="useradding" method="POST" enctype="multipart/form-data">
		<div class="user-login-wrap">
			Login<input pattern="[A-Za-z0-9]{3,}" title="Login should only contain letters and (optional) numbers" type="text" name="userLogin">
			Password<input pattern="(?=.*[a-z]){3,}" title="Password should contain 3 symbols, including any letter(s)" type="text" name="userPass">
			E-mail<input pattern="([A-z0-9_.-]{1,})@([A-z0-9_.-]{1,}).([A-z]{2,8})" type="text" name="userEmail">
			Avatar
			<input name="userImg" type="file">
			<input type="submit" name="addNewUser" value="Submit">
		</div>
	</form>
</div>


