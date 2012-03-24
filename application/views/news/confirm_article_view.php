<div id="main">
	<div class="form_box">
	<h2>News Information</h2>
	<div class="text">Title:<span class="data"><?php echo $title; ?></span></div>
	<div class="text">Message: <span class="data"><?php echo nl2br($message); ?></span></div>
	<div class="Alink"><?php echo anchor('news/news/publish_article/'.(! empty($n_id) ? $n_id : ''), 'Publish');?>
			</div>
	<div class="Alink"><?php echo anchor('news/news/edit_article/'.$n_id, 'Edit');?></div>
	</div>
	<div class="clear"></div>
</div>