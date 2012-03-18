<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset=utf-8>
<title>
	<?php 
		if(isset($title))
		{
			echo $title;
		}
	?>
</title>
<link rel="stylesheet" href="<?php echo base_url();?>css/home_style.css" type="text/css" />
</head>
<body>
<div id="wrapper">
	<header id="top_header">
	
		<div id="logout">
		<?php 
			if(isset($name))
			{
				echo $name;
			} 
		?>
		| <?php echo anchor('home/logout', 'Logout');?>
		</div>
		
	Header
	
	</header>
	
