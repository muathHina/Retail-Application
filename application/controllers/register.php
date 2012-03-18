<?php 

class Register extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('register_model');
	}
	/**
	 * will load the registeration form.
	 * 
	 * @access	public
	 * @param	string
	 */
	function index($error = '')
	{
		$data['content'] = 'register_view';
		$data['title'] = 'Register Employee';
		$data['error'] = $error;
		$this->load->view('main/template', $data);
	}
	
	/**
	 * 
	 * 
	 * @access	public
	 */
	function validate_input()
	{
		
		$this->form_validation->set_rules('employeeID', 'employee ID', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('fname', 'First name', 'trim|required|xss_clean|alpha');
		$this->form_validation->set_rules('lname', 'First name', 'trim|required|xss_clean|alpha');
		$this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean|min_length[6]|max_length[32]');
		$this->form_validation->set_rules('passwconf', 'password confirmation', 'trim|required|xss_clean|matches[password]');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
		
		if($this->form_validation->run() == FALSE)
		{ 
			$this->index();
		}
		else
		{
			$this->complete_registration();
		}
	}
	
	/**
	 * validate the login details passed from the login Form:
	 * 1. if he is actually an employee
	 * 2. has not been registered before (this is checked by the
	 * password field, if its empty means he is not registered).
	 * If all above correct proceed and set the password in the
	 * database and redirect user to homepage.
	 * 
	 * if details incorrect will direct user to the registeration form
	 * again and output a suitable message.
	 * 
	 * @access	public
	 * @return	boolean
	 */
	function complete_registration()
	{	//form validation complete, but need to check employee id and password.
		$empID = $this->input->post('employeeID');
		$fname =  strtolower($this->input->post('fname'));
		$lname =  strtolower($this->input->post('lname'));
		$pass = $this->input->post('password');

		$is_employee = $this->register_model->is_employee($empID, $fname, $lname);
		$is_registered = $this->register_model->employee_registered($empID);
		
		if(!$is_employee)
		{
			$this->index('Check your Employee ID, First and Last name');
		}
		else if(!$is_registered)
		{
			$this->index('Records show that your are registered.');
		}
		else
		{
			$this->register_model->set_password($empID, $pass); // set the password
			$data['title'] = 'Ximbar Retail System - Login';
			$data['status'] = 'Registeration Complete, You can Login now';
			$data['content'] = 'login_view';
			$this->load->view('main/template', $data);
		}
	}
}
?>