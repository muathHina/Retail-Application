<div id="login_register">
	<h1>Employee Login</h1>
	<?php echo validation_errors(); ?>
	<?php echo form_open('login/validateLogin');?>
	
	<?php echo form_input('employeeID', 'Employee ID', 'onClick=this.value="" ');?>
	<?php echo form_password('password', 'Password', 'onClick=this.value="" ');?>
	<?php echo form_submit('submit', 'Login');?>
	<?php echo anchor('register', 'Register');?>
	<?php echo form_close();?>
</div>