<div id="main">
<div class="news_box">
	<article>
		<header>
		<h1><?php echo $article['title'];?></h1>
		</header>
		<p class="snippet"><?php echo nl2br($article['message']); ?></p>
		<footer>
		<p class="footer">Date: <time pubdate="pubdate"><?php echo $article['date_created']; ?></time>&nbsp;|&nbsp;</p>
		<p class="footer">By: <?php echo $article['author']; ?></p>
		</footer>
		<div class="Alink"><?php echo anchor('news/news', 'Back to news list');?></div>
		<div class="Alink"><?php echo anchor('news/news/edit_article/'.$article['n_id'], 'Edit');?></div>
		<div class="Alink"><?php echo anchor('news/news/confirm_delete_article/'.$article['n_id'], 'Delete');?></div>
	</article>
<div class="clear"></div>
</div>
<div class="clear"></div>	
</div>