<div id="main">
	<div class="form_box">
	<?php echo validation_errors(); ?>
	<h2>News Information</h2>
		<p class="status"><?php if(isset($status)) echo $status;?></p>
		<p class="error"><?php if(isset($error)) echo $error;?></p>
		<?php echo form_open('news/news/validate_input');?>

		<div class="left">
		<?php echo form_label('Title:', 'n_title');?>
		<?php echo form_input('n_title', isset($edit_data) ? $edit_data['n_title'] : set_value('n_title')); ?>
		</div>
		<div class="left">
		<?php echo form_label('Message:', 'message');?>
		<?php echo form_textarea('message', isset($edit_data) ? $edit_data['message'] : set_value('message'));?>
		</div>
		<?php echo form_submit('submit', 'Create');
			  echo form_close();?>
			<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>