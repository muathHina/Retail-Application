<div id="main">
<div class="news_box">
<?php foreach($all_news as $i => $row): ?>
	<article>
		<header>
		<h1><?php echo $row['title'];?></h1>
		</header>
		<p class="snippet"><?php echo $row['message']; ?></p>
		<footer>
		<p class="footer">Date: <time pubdate="pubdate"><?php echo $row['date_created']; ?></time>&nbsp;|&nbsp;</p>
		<p class="footer">By: <?php echo $row['author']; ?></p>
		</footer>
		<div class="Alink"><?php echo anchor('news/news/read_news/'.$row['n_id'], 'Read');?></div>
	</article>
<?php endforeach; ?>
<div class="clear"></div>
</div>
<div class="clear"></div>	
</div>