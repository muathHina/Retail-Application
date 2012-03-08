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
		$dob = $this->input->post('dob');
		$pass = $this->input->post('password');
		$result = $this->register_model->isEmployee($empID, $dob);
	
		if($result && empNotRegistered($empID))
		{
			$this->register_model->setPassword($empID, $pass);
		}
	}
}
?>