<div id="main">
<div class="news_box">
<p class="status"><?php if(isset($status)) echo $status;?></p>
<p class="error"><?php if(isset($error)) echo $error;?></p>
<?php foreach($all_messages as $i => $row): ?>
	<article>
		<header>
		<p class="footer">From: <?php echo $row['from']; ?>&nbsp;|&nbsp;</p>
		<p class="footer">Date: <time><?php echo $row['date_sent']; ?></time></p>
		<h1><?php echo $row['subject'];?></h1>
		</header>
		<p class="snippet"><?php echo $row['body']; ?></p>
		<footer>
		
		
		</footer>
		<div class="Alink"><?php echo (!empty($row['msg_id']) ? anchor('messages/message/read_message/'.$row['msg_id'], 'Read Message') : '');?></div>
	</article>
<?php endforeach; ?>
<div class="clear"></div>
</div>
<div class="clear"></div>	
</div>
