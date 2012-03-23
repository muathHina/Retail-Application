<div id="main">
<div class="news_box">
	<article>
		<header>
		<h1><?php echo $all_news['title'];?></h1>
		</header>
		<p class="snippet"><?php echo $all_news['message']; ?></p>
		<footer>
		<p class="footer">Date: <time pubdate="pubdate"><?php echo $all_news['date_created']; ?></time>&nbsp;|&nbsp;</p>
		<p class="footer">By: <?php echo $all_news['author']; ?></p>
		</footer>
		<div class="Alink"><?php echo anchor('news/news', 'Back to news list');?></div>
		<div class="Alink"><?php echo anchor('news/news/read_news/'.$all_news['n_id'], 'Edit');?></div>
	</article>
<div class="clear"></div>
</div>
<div class="clear"></div>	
</div>