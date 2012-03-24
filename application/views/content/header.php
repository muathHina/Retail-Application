<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset=utf-8>
<title>
	<?php 
		if(isset($page_title))
		{
			echo $page_title;
		}
	?>
</title>
<link rel="stylesheet" href="<?php echo base_url();?>css/main_style.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>css/menu.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>css/form_style.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function () { 
    
    $('#nav li').hover(
        function () {
            //show its submenu
            $('ul', this).slideDown(100);
 
        }, 
        function () {
            //hide its submenu
            $('ul', this).slideUp(100);         
        }
    );
     
});
	</script>
</head>
<body>
<div id="container">
	<header id="top_header">
	<img src="<?php echo base_url(); ?>img/logo-small.gif" />
		<div id="logout">
		<span class="welcome"> Welcome
		<?php 
			if(isset($name))
			{
				echo '<span class="name">'.$name.'</span>';
			} 
		?>
		</span>
		<?php echo anchor('home/logout', 'Logout');?>
		</div>
	</header>
	
