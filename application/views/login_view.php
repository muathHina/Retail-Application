<div id="login">
	<h1>Employee Login</h1>
	<?php echo validation_errors(); ?>
	<?php echo form_open('checklogin');?>
	
	<?php echo form_input('Employee ID', 'Employee ID', 'onClick=this.value="" ');?>
	<?php echo form_password('Password', 'Password', 'onClick=this.value="" ');?>
	<?php echo form_submit('submit', 'Login');?>
	<?php echo anchor('register/validate', 'Register');?>
	<?php echo form_close();?>
</div>