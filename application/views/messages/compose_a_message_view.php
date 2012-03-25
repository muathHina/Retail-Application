<div id="main">
	<div class="form_box">
	<?php echo validation_errors(); ?>
		<p class="status"><?php if(isset($status)) echo $status;?></p>
		<p class="error"><?php if(isset($error)) echo $error;?></p>
		<?php echo form_open('messages/message/validate_input');?>
		<div class="left">
		<?php echo form_label('Recipient:', 'recipient');?>
		<?php echo form_dropdown('recipients', $recipients, set_value(''));?>
		</div>												
		<div class="left">
		<?php echo form_label('Subject:', 'subject');?>
		<?php echo form_input('subject'); ?>
		</div>
		<div class="left">
		<?php echo form_label('Message:', 'body');?>
		<?php echo form_textarea('body');?>
		</div>
		<!-- if we editing then output edit button, else create button -->
		<?php echo form_submit('submit', 'Send message');
			  echo form_close();?>
			<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>