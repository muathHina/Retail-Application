<div id="breadcrumb">

<?php 
	if(isset($breadcrumb1)) 
	{
		echo $breadcrumb1;
	}
	
	if(isset($breadcrumb2)) 
	{
		echo ' > '.$breadcrumb2;
	}
	
	if(isset($breadcrumb3)) 
	{
		echo ' > '.$breadcrumb3;
	}
?>

</div>