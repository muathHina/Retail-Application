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
	 */
	function index()
	{
		$data['content'] = 'register_view';
		$data['title'] = 'Register Employee';
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
		$this->form_validation->set_rules('check_details', '', 'callback_completeRegisteration'); 
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
		
		if($this->form_validation->run() == FALSE)
		{ 
			$this->index();
		}
		else 
		{
			$data['title'] = 'Ximbar Retail System - Login';
			$data['status'] = 'Registeration Complete, You can Login now';
			$data['content'] = 'login_view';
			$this->load->view('main/template', $data);
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
	function complete_registeration()
	{
		$empID = $this->input->post('employeeID');
		$fname =  strtolower($this->input->post('fname'));
		$lname =  strtolower($this->input->post('lname'));
		$pass = $this->input->post('password');
		
		$is_employee = $this->register_model->is_employee($empID, $fname, $lname);
		$is_registered = $this->register_model->employee_registered($empID);
		
		if(!$is_employee)
		{
			$this->form_validation->set_message('completeRegisteration', 'Check your Employee ID, First and Last name');
			return FALSE;
		}
		else if(!$is_registered)
		{
			$this->form_validation->set_message('completeRegisteration', 'Records show that your are registered.');
			return FALSE;
		}
		else
		{
			$this->register_model->setPassword($empID, $pass);
			return TRUE;
		}
	}
	
	
	function get_empID()
	{
		return $this->input->post('employeeID');
	}
	
	function get_fname()
	{
		return strtolower($this->input->post('fname'));
	}
	
	function get_lname()
	{
		return strtolower($this->input->post('lname'));
	}
	
	function get_password()
	{
		return $this->input->post('password');
	}
	
	
}
?>