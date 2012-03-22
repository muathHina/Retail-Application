<div id="main">
	<div class="form_box">
	<h2>News Information</h2>
	<div class="text">Title:<span class="data"><?php echo $n_title; ?></span></div>
	<div class="text">Message: <span class="data"><?php echo $message; ?></span></div>
	<div class="Alink"><?php echo anchor('news/news/publish_news', 'Publish');?></div>
	<div class="Alink"><?php echo anchor('news/news/edit_news', 'Edit');?></div>
	</div>
	<div class="clear"></div>
</div>