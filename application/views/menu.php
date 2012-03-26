<nav>
	<ul id="nav">
	    <li><a href="#">Retail</a>
	    	<ul>
	            <li><?php echo anchor('employee/add_emp', 'Add Employee');?></li>
	            <li><a href="#">View Employee</a></li>
	            <li><a href="#">Assign a Shift</a></li>
	            <li><a href="#">View Shift</a></li>
	        </ul>
	        <div class="clear"></div>    
	    </li>
	    <li><a href="#">Employee</a>
	        <ul>
	            <li><?php echo anchor('employee/personal_info', 'Personal info');?></li>
	            <li><a href="#">View Shift</a></li>
	        </ul>
	        <div class="clear"></div>
	    </li>
	    <li><a href="#">News</a>
	    <ul>
	        <li><?php echo anchor('news/news', 'Read');?></li>
	        <li><?php echo anchor('news/news/form_news', 'Create');?></li>
	    </ul>         
	        <div class="clear"></div>
	    </li>
	    <li><a href="#">Messages</a>
		    <ul>
		        <li><?php echo anchor('messages/message', 'Read');?></li>
		        <li><?php echo anchor('messages/message/compose_message', 'Compose');?></li>
		    </ul> 
		    	<div class="clear"></div>    
	    </li>
	</ul>
	<div class="clear"></div>
</nav>