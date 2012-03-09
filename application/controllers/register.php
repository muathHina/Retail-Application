<?php 

class Register extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('register_model');
	}
	
	/*
	 * will load the registeration form
	 */
	function index()
	{
		$data['content'] = 'register_view';
		$data['title'] = 'Register Employee';
		$this->load->view('main/template', $data);
	}
	
	function validateInput()
	{
		$this->form_validation->set_rules('employeeID', 'employee ID', 'trim|required|xss_clean');
		$this->form_validation->set_rules('fname', 'First name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('lname', 'First name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean|min_length[6]|max_length[32]');
		$this->form_validation->set_rules('passwconf', 'password confirmation', 'trim|required|xss_clean|matches[password]');
		$this->form_validation->set_rules('check_details','callback_completeRegisteration');
		$this->form_validation->set_error_delimiters('<p id="error">', '</p>');
		
		if($this->form_validation->run() == FALSE) $this->index();
		else $this->completeRegisteration();
	}
	
	/*
	 * 1- get empID, dob and password.
	 * 2- verrify that the empID and DOB are correct.
	 * 3- check the password field is empty for new users.
	 * 4- if all above is correct then password field is 
	 * set and that completes registeration.
	 */
	function completeRegisteration()
	{
		$empID = $this->input->post('employeeID');
		$fname =  strtolower($this->input->post('fname'));
		$lname =  strtolower($this->input->post('lname'));
		$pass = $this->input->post('password');
		$result = $this->register_model->isEmployee($empID, $fname, $lname);
	
		if(!$result)
		{
			$this->form_validation->set_message('completeRegisteration', 'Check your Employee ID, First and Last name');
			$this->index();
		}
		if(!empNotRegistered($empID))
		{
			$this->form_validation->set_message('completeRegisteration', 'Records show that your are registered.');
			$this->index();
		}
		else
		{
			$this->register_model->setPassword($empID, $pass);
			redirect('home', 'refresh');
		}
	}
}
?>