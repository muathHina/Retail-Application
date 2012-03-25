<?php 

class Message extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('messages_model');
		$this->load->model('news_model');
		$this->load->model('login_model');
	}
	
	function index($status = '')
	{
		if($this->session->session_live())
 		{
 			$data['all_messages'] = $this->messages_model->read_all_messages();
 			$data['status'] = $status ;
 			$data['breadcrumb1'] = 'Messages';
			$data['breadcrumb2'] = 'Inbox';
 			$data['name'] = $this->session->get_name();
 			$data['page_title'] = 'List Messages';
	 		$data['main'] = 'messages/list_messages_view';
			$this->load->view('content/template', $data);
 		}
 		else
 		{
 			 //If no session, redirect to login page
 			 redirect('login', 'refresh');
 		}
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param string
	 */
	function read_message($msg_id ='')
	{
		$data['message'] = $this->messages_model->read_message($msg_id);
 		$data['breadcrumb1'] = 'Messages';
		$data['breadcrumb2'] = 'Inbox';
		$data['breadcrumb3'] = $data['message']['subject'];
 		$data['name'] = $this->session->get_name();
 		$data['page_title'] = 'Read Messages';
	 	$data['main'] = 'messages/read_a_message_view';
		$this->load->view('content/template', $data);
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	function compose_message($status = '')
	{
		if($this->session->session_live())
 		{
 			$this->news_model->empty_session_table();
 			$data['status'] = $status;
 			$data['recipients'] = $this->messages_model->list_recipients();
			$data['breadcrumb1'] = 'Messages';
			$data['breadcrumb2'] = 'Compose';
			$data['name'] = $this->session->get_name();
	 		$data['page_title'] = 'Compose a Message';
		 	$data['main'] = 'messages/compose_a_message_view';
			$this->load->view('content/template', $data);
 		}
		else
 		{
 			 //If no session, redirect to login page
 			 redirect('login', 'refresh');
 		}
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	function validate_input()
	{
		$this->form_validation->set_rules('recipients', 'recipient', 'trim|required');
		$this->form_validation->set_rules('subject', 'subject', 'trim|required|max_length[80]');
		$this->form_validation->set_rules('body', 'body', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
		
		if($this->form_validation->run() == FALSE)
		{	
			$this->compose_message(); 
		}
		else
		{
			$this->send_message();
		}
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	function send_message()
	{
		$recipient = $this->input->post('recipients');
		$subject = $this->input->post('subject');
		$body = $this->input->post('body');
		$recipient_name = $this->login_model->get_name($recipient);
		$this->messages_model->send_message($subject, $body, $recipient);
		$this->index('Message sent successfully to '.$recipient_name);
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param $msg_id
	 */
	function delete_message($msg_id = '')
	{
		$data = $this->messages_model->read_message($msg_id);
		$this->messages_model->delete_message($msg_id);
		$this->index('Message "'.$data['subject'].'" deleted successfully.');
	}
}
?>