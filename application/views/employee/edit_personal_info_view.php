<div id="main">
	<div class="form_box">
	<h2>Personal Information</h2>
	<?php echo validation_errors(); ?>
		<p class="status"><?php if(isset($status)) echo $status;?></p>
		<p class="error"><?php if(isset($error)) echo $error;?></p>
		<?php echo form_open('employee/personal_info/validate_input');?>
		<div class="left">
		<?php echo form_label('First name:', 'fname');?>
		<?php $data = array(
              'name'        => 'fname',
              'value'       => $personal_info['fname'],
              'disabled'   => 'disabled');?>
		<?php echo form_input($data); ?>
		</div>
		
		<div class="left">
		<?php echo form_label('Last name:', 'lname');?>
		<?php $data = array(
              'name'        => 'lname',
              'value'       => $personal_info['lname'],
              'disabled'   => 'disabled');?>
		<?php echo form_input($data); ?>
		</div>
		
		<div class="left">
		<?php echo form_label('Phone number:', 'phone');?>
		<?php echo form_input('phone', isset($post_data) ? $post_data['phone'] : $personal_info['phone']); ?>

		</div>
		<div class="left">
		<?php echo form_label('Email:', 'email');?>
		<?php echo form_input('email', isset($post_data) ? $post_data['email'] : $personal_info['email']); ?>
		</div>
		<div class="left">
		<?php echo form_label('Password:', 'password');?>
		<?php $data = array(
              'name'        => 'password',
              'value'       => $personal_info['password'],
              'disabled'   => 'disabled');?>
		<?php echo form_input($data); ?>
		</div>
		<p class="note">* For extra security measures, password must be entered for changes to be approved.</p>
		<div class="left">
		<?php echo form_label('Current password:', 'current_password');?>
		<?php echo form_password('current_password', set_value('')); ?>
		</div>
		<p class="note">* To change password fill-in the following, or leave blank for no change.</p>
		<div class="left">
		<?php echo form_label('New password:', 'newpassword');?>
		<?php echo form_password('newpassword', set_value('')); ?>
		</div>
		<div class="left">
		<?php echo form_label('Confirm password:', 'passwordconf');?>
		<?php echo form_password('passwordconf', set_value('')); ?>
		</div>
	<h2>Address Information</h2>
		<div class="left">
		<?php echo form_label('House number:', 'house_no');?>
		<?php echo form_input('house_no', isset($post_data) ? $post_data['house_no'] : $personal_info['house_no']); ?>
		</div>
		<div class="left">
		<?php echo form_label('Street:', 'street');?>
		<?php echo form_input('street', isset($post_data) ? $post_data['street'] : $personal_info['street']); ?>
		</div>
		<div class="left">
		<?php echo form_label('City:', 'city');?>
		<?php echo form_input('city', isset($post_data) ? $post_data['city'] : $personal_info['city']); ?>
		</div>
		<div class="left">
		<?php echo form_label('County:', 'county');?>
		<?php echo form_input('county', isset($post_data) ? $post_data['county'] : $personal_info['county']); ?>
		</div>
		<div class="left">
		<?php echo form_label('Post code:', 'post_code');?>
		<?php echo form_input('post_code', isset($post_data) ? $post_data['post_code'] : $personal_info['post_code']); ?>
		</div>
	<h2>Other Information</h2>
		<div class="left">
		<?php echo form_label('Job type:', 'jobtype');?>
		<?php $data = array(
              'name'        => 'jobtype',
              'value'       => $personal_info['jobtype'],
              'disabled'   => 'disabled');?>
		<?php echo form_input($data); ?>
		</div>
		<div class="left">
		<?php echo form_label('Department:', 'department');?>
		<?php $data = array(
              'name'        => 'department',
              'value'       => $personal_info['dep_name'],
              'disabled'   => 'disabled');?>
		<?php echo form_input($data); ?>
		</div>
		
		<div class="left">
		<?php echo form_label('Date joined:', 'date_joined');?>
		<?php $data = array(
              'name'        => 'date_joined',
              'value'       => $personal_info['date_joined'],
              'disabled'   => 'disabled');?>
		<?php echo form_input($data); ?>
		</div>
		
		<div class="left">
		<?php echo form_label('Shift ID:', 'shift_id');?>
		<?php $data = array(
              'name'        => 'shift_id',
              'value'       => $personal_info['shift_id'],
              'disabled'   => 'disabled');?>
		<?php echo form_input($data); ?>
		</div>
		<?php 
			echo form_submit('submit', 'Update Information');
			echo form_close();?>
				<div class="Alink"><?php echo anchor('employee/personal_info', 'Cancel');?></div>
			<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>