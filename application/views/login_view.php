<div id="login_register">
	<img src="<?php echo base_url(); ?>img/logo.gif" />
	<h2>Login</h2>
	<?php echo validation_errors(); ?>
	<p class="status"><?php if(isset($status)) echo $status;?></p>
	<p class="error"><?php if(isset($error)) echo $error;?></p>
	<?php echo form_open('login/validate_input');?>
	<label for="employeeID">Employee ID:</label>
	<?php echo form_input('employeeID', '', 'onClick=this.value="" ');?>
	<label for="password">Password:</label>
	<?php echo form_password('password', '', 'onClick=this.value="" ');?>
	<?php echo form_submit('submit', 'Login');?>
	<?php echo anchor('register', 'Register');?>
	<?php echo form_close();?>
</div>