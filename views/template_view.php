<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-177234279-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'UA-177234279-1');
	</script>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CRM</title>
	<?php if(isset($data['theme'])){ ?>
		<link rel="stylesheet" href="/Templates/css/light-style.css">
		<link rel="stylesheet" href="/Templates/css/<?php echo $data['theme']?>-style.css">
	<?php }else{ ?>
		<link rel="stylesheet" href="/Templates/css/light-style.css">
	<?php } ?>
	<link rel="stylesheet" href="/Templates/css/media.css">
	<link rel="shortcut icon" href="/Templates/img/favicon.ico" type="image/x-icon">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<body>
	<?php
	if($data['header'] == true)
	{
		include 'views/header.php';
	}
	?>
	<?php include 'views/'.$content_view; ?>
<!-- 	<div class='chat' id='chatId' style="display: none;">
	<i class="far fa-times-circle fa-2x" style="position: absolute;right:1px; color: red" onclick="closewindow('chatId')"></i>
	<div class='chat-messages'>
		<div class='chat-messages__content' id='messages'>
		</div>
	</div>
	<div class='chat-input'>
		<form id='chat-form'>
			<input type='text' id='message-text' class='chat-form__input' placeholder='Введите сообщение' name="message">
			<input type='submit' class='chat-form__submit' value="">
		</form>
	</div>
</div>
<div id="fastChat" style="">
	<div class="groupChat">
		<i class="fas fa-plus fa-2x" style="color: white; padding:10px;" onclick="createGroupChat()"></i>
	</div>
	<div id="fastChatMessages">
	</div>
	<div id="fastGroupChatMessages">
	</div>
</div> -->
<?php include 'views/footer.php' ?>
</body>
<script src="https://kit.fontawesome.com/963765d61f.js" crossorigin="anonymous"></script>
</html>