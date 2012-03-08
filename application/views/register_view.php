
<fieldset>
	<legend>Your information</legend>
<label for="employeeID">Employee ID:</label>
	<?php
	echo form_open('register/completeRegisteration');
	echo form_input('employeeID');?>
	<label for="dob">Date of Birth:</label>
	<?php echo form_input('dob', 'e.g.1984-05-23', 'onClick=this.value="" ');?>
	<label for="password">Password:</label>
	<?php echo form_password('password');?>
	<label for="password">Confirm password:</label>
	<?php echo form_password('password2');?>
	<?php echo form_submit('submit', 'Register');?>
	<?php echo anchor('login', 'Back to Login');?>
	<?php echo form_close();?>
</fieldset>
