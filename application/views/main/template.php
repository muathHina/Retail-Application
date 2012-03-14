<?php $this->load->view('main/header'); ?>
<?php
	if(isset($nav)) 
	{
		$this->load->view($nav);
	}
?>
<?php $this->load->view($content); ?>

<?php $this->load->view('main/footer'); ?>