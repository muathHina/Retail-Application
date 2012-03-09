<fieldset>
	<legend>Your information</legend>
	<?php echo validation_errors(); ?>
	
	<label for="employeeID">Employee ID:</label>
	<?php echo form_open('register/validateInput');
		echo form_input('employeeID');?>
		
	<label for="fname">First name:</label>
	<?php echo form_input('fname');?>
	
	<label for="lname">Last name:</label>
	<?php echo form_input('lname');?>
	
	<label for="password">Password:</label>
	<?php echo form_password('password'); ?>
	
	<label for="password">Confirm password:</label>
	<?php 
		echo form_password('passwconf');
		echo form_hidden('check_details');
		echo form_submit('submit', 'Register');
		echo anchor('login', 'Back to Login');
		echo form_close();?>
</fieldset>
