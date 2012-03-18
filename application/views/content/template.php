<?php $this->load->view('content/header'); ?>
<?php
	if(isset($nav)) 
	{
		$this->load->view($nav);
	}
?>
<?php $this->load->view($main); ?>

<?php $this->load->view('content/footer'); ?>