<?php 

class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}
	
	function index()
	{
		$data['content'] = 'login_view';
		$this->load->view('main/template', $data);
	}
	
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
	 * New employees will need to enter their employee ID which
	 * is given to them and their DOB, and then choose their own
	 * password. If employee ID and DOB match the system will register
	 * them by updating their password.
	 */
	function register()
	{
		$data['content'] = 'register_view';
		$this->load->view('main/template', $data);
	}
	
	function validateRegisteration()
	{
		$empID = $this->input->post('employeeID');
		$pass = $this->input->post('dob');
		$result = $this->login_model->verifyRegisteration($empID, $pass);
		
		if($result)
		{
			
		}
	}
}
?>