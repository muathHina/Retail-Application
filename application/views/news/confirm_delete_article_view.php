<div id="main">
	<div class="form_box">
	<h2>Article Information</h2>
	<div class="text">Title:<span class="data"><?php echo $article['title']; ?></span></div>
	<div class="Alink"><?php echo anchor('news/news/delete_article/'.$article['n_id'], 'Yes, Delete Article');?></div>
	<div class="Alink"><?php echo anchor('news/news', 'No, Cancel');?></div>
	</div>
	<div class="clear"></div>
</div>