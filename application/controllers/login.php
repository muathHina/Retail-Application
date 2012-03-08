<?php 

class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}
	
	/* load the login page */
	function index()
	{
		$data['content'] = 'login_view';
		$data['title'] = 'Employee Login';
		$this->load->view('main/template', $data);
	}
	/*
	 * validate the login details passed from the login Form
	 * if details correct continue to home page, else redirect
	 * to login page to enter details again.
	 */
	function validateLogin()
	{
		$empID = $this->input->post('employeeID');
		$pass = $this->input->post('password');
		$query = $this->login_model->verifyLogin($empID, $pass);
		
		if($query)
		{
			$session_data = array (
				'EmployeeID' => $empID,
				'logged_in' => true,
				'date'	=> date("Y, m, d"),
				'time'	=> date("H:i:s"));
			$this->session->set_userdata($session_data);
			redirect('home');
		}
		else
		{
			$this->index();
		}
	}
	
	/*
	 * will load the registeration form
	 */
	function register()
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
		$result = $this->login_model->verifyRegisteration($empID, $dob);
	
		if($result && passwordIsEmpty($empID))
		{
			$this->login_model->setPassword($empID, $pass);
		}
	}
}
?>