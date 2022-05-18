<div class="balance">
	<div class="balance-form">
		<div class="balance-form-header">
			<div class="balance-logo">
				
			</div>
			<div class="balance-info">
				<h3>hg.01company.ru</h3>
				<span>Пополнение баланса <?php echo $data['login'] ?></span>
			</div>
			<a href="<?php echo $data['referer']?>"><i class="fa fa-times fa-2x balance-close"></i></a> 
		</div>
		<div class="balance-qiwi-block">
			<div class="qiwi-logo">
				
			</div>
		</div>
		<div class="balance-qiwi">
			<form action="balance/bill" method="POST">
				<!--<input type="tel" pattern="+/[0-9]{11}" placeholder="+7 (___) ___-__-__" value="+7" name="phone">-->
				<style> input[type="text"]::placeholder{ text-align: left; } </style>
				<input type="text" id="sum" placeholder="Сумма пополнения
				" name="sum" onkeyup="this.value = this.value.replace(/[^\d]/g,'');" >
				<button value="">Оплатить</button>
			</form>
			<span>В сумму включена комиссия при оплате картой: <span id='comission'></span> ₽</span>
			<span>Платеж защищен сертификатом TLS и протоколом 3D Secure</span>
			<a href="<?php echo $data['referer'] #эхо решает проблему с тем что в момент нажатия на кнопку реферер меняется на текущий адрес?>">Вернуться на сайт</a>
		</div>
		<div class="balance-form-footer">
			<img src="/Templates/img/paymethods.svg" alt="">
		</div>
	</div>
</div>
<script>
    var comission = document.getElementById('comission');
    $('#sum').on('keyup', function(){
    	var com = $('#sum').val() * 0.02;
        comission.textContent = com;
    })


</script>