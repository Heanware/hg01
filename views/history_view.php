<div class="history">
	<?php if(count($data['history']) != 0){ ?>	
	<table>		
			<tr>
				<th>Operation</th>
				<th>Status</th>
				<th>Count</th>
				<th>From</th>
				<th>To</th>
			</tr>
		<?php foreach ($data['history'] as $userHistory) { 
			?>
			<tr>
				<td><?php echo $userHistory['operation'] ?></td>
				<td><?php echo $userHistory['status'] ?></td>
				<td><?php echo $userHistory['count'] ?></td>
				<?php if ($data['login'] == $userHistory['user_in']) { 
					?>
					<td><a href="/cabinet/user/<?php echo $userHistory['user_out'] ?>"><?php echo $userHistory['user_out'] ?></a></td>
					<td><a href="/cabinet/user/<?php echo $data['login'] ?>"><?php echo $data['login'] ?></a></td>
				<?php }else if($data['login'] == $userHistory['user_out']){ ?>
					<td><a href="/cabinet/user/<?php echo $data['login'] ?>"><?php echo $data['login'] ?></a></td>
					<td><a href="/cabinet/user/<?php echo $userHistory['user_in'] ?>"><?php echo $userHistory['user_in'] ?></a></td>
				</tr>
			<?php }
		} ?>
	</table>
		<?php } ?>
</div>