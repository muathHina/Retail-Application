<?php 

class Login extends CI_Controller
{
	var $status;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}
	
	/**
	 * will load the login page with any error messages passed
	 * to the parameter. By default error field will be empty if
	 * nothing is passed.
	 * 
	 * @access	public
	 * @param 	string
	 */
	function index($error = '')
	{
		$data['content'] = 'login_view';
		$data['title'] = 'Ximbar Retail System - Login';
		$data['error'] = $error;
		$this->load->view('main/template', $data);
	}
	
	/**
	 * will validate input from the login form and check through
	 * another local method (validate_login) if the Employee ID
	 * and password is correct, if not it will return an error 
	 * message. if input type and login details are correct then
	 * user will be directed straight to the home page.
	 * 
	 * @access	public
	 */
	function validate_input()
	{
		$this->form_validation->set_rules('employeeID', 'Employee ID', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else if (!$this->validate_login())
		{
			$this->index('Invalid username or password');
		}
		else
		{
			redirect('home', 'refresh');
		}
	}
	
	/**
	 * validate the login details passed from the login Form
	 * if details correct continue to home page, else redirect
	 * to login page to enter details again
	 * 
	 * @access	public
	 * @return	boolean
	 */
	function validate_login()
	{
		$empID = $this->input->post('employeeID');
		$pass = $this->input->post('password');
		$query = $this->login_model->verify_login($empID, $pass);
		
		if($query)
		{
			$session_data = array (
				'EmployeeID' => $empID,
				'logged_in' => TRUE,
				'date'	=> date("Y, m, d"),
				'time'	=> date("H:i:s"));
			$this->session->set_userdata($session_data);
			return TRUE;
		}
		return FALSE;
	}
}
?>