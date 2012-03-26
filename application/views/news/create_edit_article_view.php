<div id="main">
	<div class="form_box">
	<?php echo validation_errors(); ?>
	<h2>Article Information</h2>
		<p class="status"><?php if(isset($status)) echo $status;?></p>
		<p class="error"><?php if(isset($error)) echo $error;?></p>
		<?php echo form_open('news/news/validate_input/'.(isset($edit_data['n_id']) ? $edit_data['n_id'] : ''));?>
														
		<div class="left">
		<?php echo form_label('Title:', 'title');?>
		<?php echo form_input('title', isset($edit_data) ? $edit_data['title'] : set_value('title')); ?>
		</div>
		<div class="left">
		<?php echo form_label('Message:', 'message');?>
		<?php echo form_textarea('message', isset($edit_data) ? $edit_data['message'] : set_value('message'));?>
		</div>
		<!-- if we editing then output edit button, else create button -->
		<?php echo (isset($edit_data)) ? form_submit('submit', 'Finish Editing') : form_submit('submit', 'Create');
			  echo form_close();?>
			<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>