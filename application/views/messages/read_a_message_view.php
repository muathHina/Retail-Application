<div id="main">
<div class="news_box">
	<article>
		<header>
		<p class="footer">From: <?php echo $message['from']; ?>&nbsp;|&nbsp;</p>
		<p class="footer">Date: <time><?php echo $message['date_sent']; ?></time></p>
		<h1><?php echo $message['subject'];?></h1>
		</header>
		<p class="snippet"><?php echo nl2br($message['body']); ?></p>
		<footer>
		
		</footer>
		<div class="Alink"><?php echo anchor('messages/message', 'Back to inbox');?></div>
		<div class="Alink"><?php echo anchor('messages/message/delete_message/'.$message['msg_id'], 'Delete message');?></div>
	</article>
<div class="clear"></div>
</div>
<div class="clear"></div>	
</div>