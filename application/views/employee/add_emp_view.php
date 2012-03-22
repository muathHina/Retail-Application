<div id="main">
	<div class="form_box">
	<?php echo validation_errors(); ?>
	<h2>Personal Information</h2>
		<p class="status"><?php if(isset($status)) echo $status;?></p>
		<p class="error"><?php if(isset($error)) echo $error;?></p>
		<?php echo form_open('employee/add_emp/validate_input');?>
		<div class="left">
		<?php echo form_label('First name:', 'fname');?>
		<?php echo form_input('fname', isset($edit_data) ? $edit_data['fname'] : set_value('fname')); ?>

		</div>
		<div class="left">
		<?php echo form_label('Last name:', 'lname');?>
		<?php echo form_input('lname', isset($edit_data) ? $edit_data['lname'] : set_value('lname')); ?>
		</div>
		
		<div class="left">
		<?php 
			if (isset($edit_data))
			{
				$formdate->year['selected'] = $edit_data['y'];
				$formdate->month['selected'] = $edit_data['m'];
				$formdate->day['selected'] = $edit_data['d'];
			}
		?>
		<?php echo form_label('Date of Birth:', 'dob');?>
		<?php echo $formdate->selectYear();?>
		<?php echo $formdate->selectMonth();?>
		<?php echo $formdate->selectDay();?>
		</div>
		
		<div class="left">
		<?php echo form_label('Phone number:', 'phone');?>
		<?php echo form_input('phone', isset($edit_data) ? $edit_data['phone'] : set_value('phone')); ?>

		</div>
		<div class="left">
		<?php echo form_label('Email:', 'email');?>
		<?php echo form_input('email', isset($edit_data) ? $edit_data['email'] : set_value('email')); ?>
		</div>
	<h2>Address Information</h2>
		<div class="left">
		<?php echo form_label('House number:', 'house_no');?>
		<?php echo form_input('house_no', isset($edit_data) ? $edit_data['house_no'] : set_value('house_no')); ?>
		</div>
		<div class="left">
		<?php echo form_label('Street:', 'street');?>
		<?php echo form_input('street', isset($edit_data) ? $edit_data['street'] : set_value('street')); ?>
		</div>
		<div class="left">
		<?php echo form_label('City:', 'city');?>
		<?php echo form_input('city', isset($edit_data) ? $edit_data['city'] : set_value('city')); ?>
		</div>
		<div class="left">
		<?php echo form_label('County:', 'county');?>
		<?php echo form_input('county', isset($edit_data) ? $edit_data['county'] : set_value('county')); ?>
		</div>
		<div class="left">
		<?php echo form_label('Post code:', 'post_code');?>
		<?php echo form_input('post_code', isset($edit_data) ? $edit_data['post_code'] : set_value('post_code')); ?>
		</div>
	<h2>Other Information</h2>
		<div class="left">
		<?php echo form_label('Job type:', 'jobtype');?>
		<?php echo form_dropdown('jobtype', $jobtype, isset($edit_data) ? $edit_data['jobtype'] : set_value('jobtype'));?>
		</div>
		<div class="left">
		<?php echo form_label('Department:', 'department');?>
		<?php echo form_dropdown('department', $department, isset($edit_data) ? $edit_data['department'] : set_value('department'));?>
		</div>
		<?php 
			echo form_submit('submit', 'Submit Information');
			echo form_close();?>
			<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>