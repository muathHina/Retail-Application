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
	
	function validateInput()
	{
		$this->form_validation->set_rules('employeeID', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Username', 'trim|required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('login_view');
		}
		else
		{
			redirect('home', 'refresh');
		}
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
	
	
}
?>