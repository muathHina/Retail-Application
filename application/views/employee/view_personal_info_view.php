<div id="main">
	<div class="form_box">
	<p class="status"><?php if(isset($status)) echo $status;?></p>
	<p class="error"><?php if(isset($error)) echo $error;?></p>
	<h2>Personal Information</h2>
	<div class="text">Employee ID:<span class="data"><?php echo $personal_info['emp_id']; ?></span></div>
	<div class="text">First name:<span class="data"><?php echo $personal_info['fname']; ?></span></div>
	<div class="text">last name: <span class="data"><?php echo $personal_info['lname']; ?></span></div>
	<div class="text">Date of birth: <span class="data"><?php echo $personal_info['dob']; ?></span></div>
	<div class="text">Phone number: <span class="data"><?php echo $personal_info['phone']; ?></span></div>
	<div class="text">Email Address: <span class="data"><?php echo $personal_info['email']; ?></span></div>
	<div class="text">Password: <span class="data"><?php echo $personal_info['password']; ?></span></div>
	<h2>Address Information</h2>
	<div class="text">House number: <span class="data"><?php echo $personal_info['house_no']; ?></span></div>
	<div class="text">Street name: <span class="data"><?php echo $personal_info['street']; ?></span></div>
	<div class="text">City: <span class="data"><?php echo $personal_info['city']; ?></span></div>
	<div class="text">County: <span class="data"><?php echo $personal_info['county']; ?></span></div>
	<div class="text">Post code: <span class="data"><?php echo $personal_info['post_code']; ?></span></div>
	<h2>Other Information</h2>
	<div class="text">Job type: <span class="data"><?php echo $personal_info['jobtype']; ?></span></div>
	<div class="text">Department: <span class="data"><?php echo $personal_info['dep_name']; ?></span></div>
	<div class="text">Date Joined: <span class="data"><?php echo $personal_info['date_joined']; ?></span></div>
	<div class="text">Shift ID: <span class="data"><?php echo $personal_info['shift_id']; ?></span></div>
	<div class="Alink"><?php echo anchor('employee/personal_info/edit_personal_info', 'Edit');?></div>
	</div>
	<div class="clear"></div>
</div>