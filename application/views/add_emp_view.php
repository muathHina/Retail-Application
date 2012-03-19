<div id="main">
	<div class="form_box">
	<h2>Personal Information</h2>
		<?php echo validation_errors(); ?>
		<p class="error"><?php if(isset($error)) echo $error;?></p>
		<?php echo form_open('register/validate_input');?>
		
		<div class="left">
		<?php echo form_label('First name:', 'fname');?>
		<?php echo form_input('fname');?>
		</div>
		
		<div class="left">
		<?php echo form_label('Last name:', 'lname');?>
		<?php echo form_input('lname');?>
		</div>
		
		<div class="left">
		<?php echo form_label('Date of Birth:', 'dob');?>
		<?php echo form_input('dob');?>
		</div>
		
		<div class="left">
		<?php echo form_label('Phone number:', 'phone');?>
		<?php echo form_input('phone');?>
		</div>
		
		<div class="left">
		<?php echo form_label('Email:', 'email');?>
		<?php echo form_input('email');?>
		</div>
	
	<h2>Address Information</h2>
	
		<div class="left">
		<?php echo form_label('House number:', 'houseno');?>
		<?php echo form_input('houseno');?>
		</div>
	
		<div class="left">
		<?php echo form_label('Street:', 'sname');?>
		<?php echo form_input('sname');?>
		</div>
	
		<div class="left">
		<?php echo form_label('City:', 'city');?>
		<?php echo form_input('city');?>
		</div>
	
		<div class="left">
		<?php echo form_label('County:', 'county');?>
		<?php echo form_input('county');?>
		</div>
	
		<div class="left">
		<?php echo form_label('Post code:', 'postcode');?>
		<?php echo form_input('postcode');?>
		</div>
	
		<div class="left">
			<h2>Other Information</h2>
		</div>
	
		<div class="left">
		<?php echo form_label('Job type:', 'jobtype');?>
		<?php echo form_input('jobtype');?>
		</div>
	
		<div class="left">
		<?php echo form_label('Department:', 'department');?>
		<?php echo form_input('department');?>
		</div>
	
		<div class="left">
		<?php echo form_label('Date joined:', 'datejoined');?>
		<?php echo form_input('datejoined');?>
		</div>
		<?php 
			echo form_submit('submit', 'Submit Information');
			echo form_close();?>
			<div class="clear"></div>
	</div>
	
	
	
	
	<div class="clear"></div>
</div>