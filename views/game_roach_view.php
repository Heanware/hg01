	<div class="gameroach" id="gameroach">
		<canvas id="canvas" width="512" height="900"></canvas>
<!-- 		<div id="restart">
			<h3>Do you want to try again?</h3>
			<div class="choice">
				<form action="" id="restartRequest" method='POST'>
					<button name="restartRequest" value="0">Yes</button>
					<button name="restartRequest" value="-1">No</button>
				</form>
			</div>
		</div> -->
		<div id="chat-result" style="border: 1px solid"></div>
		<!-- <script src="/game_engine/ROACH/js/game.js"></script> -->
		<script>
			$(function () {
				var socket = io();
				$('form').submit(function(e) {
      e.preventDefault(); // prevents page reloading
      socket.emit('chat message', $('#m').val());
      $('#m').val('');
      return false;
  });
</script>
</div>


