<div id="main">
	<div class="form_box">
	<h2>Personal Information</h2>
	<div class="text">First name:<span class="data"><?php echo $fname; ?></span></div>
	<div class="text">last name: <span class="data"><?php echo $lname; ?></span></div>
	<div class="text">Date of birth: <span class="data"><?php echo $dob; ?></span></div>
	<div class="text">Phone number: <span class="data"><?php echo $phone; ?></span></div>
	<div class="text">Email Address: <span class="data"><?php echo $email; ?></span></div>
	<h2>Address Information</h2>
	<div class="text">House number: <span class="data"><?php echo $house_no; ?></span></div>
	<div class="text">Street name: <span class="data"><?php echo $street; ?></span></div>
	<div class="text">City: <span class="data"><?php echo $city; ?></span></div>
	<div class="text">County: <span class="data"><?php echo $county; ?></span></div>
	<div class="text">Post code: <span class="data"><?php echo $post_code; ?></span></div>
	<h2>Other Information</h2>
	<div class="text">Job type: <span class="data"><?php echo $jobtype; ?></span></div>
	<div class="text">Department: <span class="data"><?php echo $department; ?></span></div>
	<div class="Alink"><?php echo anchor('employee/add_emp/add_employee', 'Confirm');?></div>
	<div class="Alink"><?php echo anchor('employee/add_emp/edit_employee', 'Edit');?></div>
	</div>
	<div class="clear"></div>
</div>