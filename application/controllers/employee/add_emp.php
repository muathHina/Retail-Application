<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_emp extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('add_emp_model');
	}
	/**
	 * This will setup the add employee page. 
	 * The following will be done to the page:
	 * 
	 * 1- setup the breadcrumbs for the page
	 * 2- will populate the date of birth drop down menu
	 * 3- will fetch enum values for job type field and
	 * put them in a drop down menu.
	 * 4- will fetch the department names and put them in
	 * drop down menu.
	 * 5- will set any feedback message in the status variable
	 * 6- will pass the name of the user logged in for this session.
	 * 7- will pass the title page name
	 * 8- the main page to load which is the add employee View
	 * 
	 * @access public
	 * @param string
	 */
	function index($status ='')
	{
		if($this->session->session_live())
 		{
 			$this->session->unset_userdata('post_data'); //unset session, fresh start
			$data['breadcrumb1'] = 'Retail';
			$data['breadcrumb2'] = 'Add Employee';
			$data['formdate'] = $this->setup_date_menu();
			$data['jobtype'] = $this->add_emp_model->enum_select('employee' , 'jobtype');
			$data['department'] = $this->add_emp_model->get_list_department();
			$data['status'] = $status;
			$data['name'] = $this->session->get_name();
	 		$data['title'] = 'Add Employee';
		 	$data['main'] = 'employee/add_emp_view';
			$this->load->view('content/template', $data);
 		}
		else
 		{
 			 //If no session, redirect to login page
 			 redirect('login', 'refresh');
 		}
	}
	
	/**
	 * validate the input data from the form
	 * @return string
	 */
	function validate_input()
	{ 	          	
		$this->form_validation->set_rules('fname', 'first name', 'trim|required|alpha_dash_space');
		$this->form_validation->set_rules('lname', 'last name', 'trim|required|alpha_dash_space');
		$this->form_validation->set_rules('dob', 'date of birth', 'callback_valid_date');
		$this->form_validation->set_rules('phone', 'phone number', 'trim|required|numeric|max_length[11]');
		$this->form_validation->set_rules('email', 'email address', 'trim|required|valid_email');
		$this->form_validation->set_rules('house_no', 'house number', 'trim|required|numeric');
		$this->form_validation->set_rules('street', 'street name', 'trim|required|alpha_dash_space');
		$this->form_validation->set_rules('city', 'city name', 'trim|required|alpha_dash_space');
		$this->form_validation->set_rules('county', 'county name', 'trim|required|alpha_dash_space');
		$this->form_validation->set_rules('post_code', 'post code', 'trim|required|alpha_dash_space|max_length[8]');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
		
		if($this->form_validation->run() == FALSE)
		{	// if this exist then we are in the stage of editing the data
			if($this->session->userdata('post_data'))
			{
				$this->edit_employee();
			}
			else
			{
				$this->index();
			}
		}
		else
		{
			$this->set_data_session();
			$this->confirm_info();
		}
	}
	
	/**
	 * this will create a view for the user where information
	 * entered can be viewed and confirmed or edited if needed.
	 * 
	 * @access public
	 */
	function confirm_info()
	{	// retrieve post data from the session object
		$p_data = $this->session->userdata('post_data');
		// will pass all data, so then it will be saved to the database when confirm button pressed.
		$data['fname'] = $p_data['fname'];
		$data['lname'] = $p_data['lname'];
		$data['dob'] = 	$p_data['d'].'-'.$p_data['m'].'-'.$p_data['y'];
		$data['phone'] = $p_data['phone'];
		$data['email'] = $p_data['email'];
		$data['house_no'] = $p_data['house_no'];
		$data['street'] = $p_data['street'];
		$data['city'] = $p_data['city'];
		$data['county'] = $p_data['county'];
		$data['post_code'] = $p_data['post_code'];
		$data['jobtype'] = $p_data['jobtype'];
		$data['department'] = $p_data['department'];
		
		$data['breadcrumb1'] = 'Retail';
		$data['breadcrumb2'] = 'Add Employee';
		$data['breadcrumb3'] = 'Confirm Information';
 		$data['name'] = $this->session->get_name();
 		$data['title'] = 'Add Employee Confirmation';
		$data['main'] = 'employee/confirm_emp_view';
		$this->load->view('content/template', $data);
	}
	
	/**
	 * Get the form data from the session object and pass it to the
	 * database. When calling the index function will unset the 
	 * form data from the session object.
	 * 
	 * @access public
	 */
	function add_employee()
	{
		$data = $this->session->userdata('post_data');
		$this->add_emp_model->add_employee_to_db($data);
		$this->index('Employee added successfully to the database');
	}
	
	/**
	 * This will load the form with the data entered by the user to be edited.
	 * The data will first be retrieved from the session object and then passed
	 * to the View where the data is extracted and populated in the correct input 
	 * field depending on the input field name it was assigned to.
	 * 
	 * @access public
	 */
	function edit_employee()
	{
		$data['edit_data'] = $this->session->userdata('post_data'); //retrieve data and pass it to the form to re-populate input fields
		$data['breadcrumb1'] = 'Retail';
		$data['breadcrumb2'] = 'Add Employee';
		$data['breadcrumb3'] = 'Edit Employee';
		$data['formdate'] = $this->setup_date_menu();
		$data['jobtype'] = $this->add_emp_model->enum_select('employee' , 'jobtype');
		$data['department'] = $this->add_emp_model->get_list_department();
		$data['name'] = $this->session->get_name();
	 	$data['title'] = 'Edit Employee';
		$data['main'] = 'employee/add_emp_view';
		$this->load->view('content/template', $data);
		
	}
	
	/**
	 * get all the data from the form and save it in 
	 * a session object. This will help to retrieve data
	 * at later stage for editing
	 * 
	 * @access public
	 */
	function set_data_session()
	{	//unset if exist, when we edit we need to unset and set the new data.
		$this->session->unset_userdata('post_data'); 
		$m = $this->input->post('dob_month');
		$d = $this->input->post('dob_day');
		$y = $this->input->post('dob_year');
		$post_data = array(
				'm'=>$m,
				'd'=>$d,
				'y'=>$y,
				'fname'=>$this->input->post('fname'),
				'lname'=>$this->input->post('lname'),
				'dob'=>$y.'-'.$m.'-'.$d,
				'phone'=>$this->input->post('phone'),
				'email'=>$this->input->post('email'),
				'house_no'=>$this->input->post('house_no'),
				'street'=>$this->input->post('street'),
				'city'=>$this->input->post('city'),
				'county'=>$this->input->post('county'),
				'post_code'=>$this->input->post('post_code'),
				'jobtype'=>$this->input->post('jobtype'),
				'department'=>$this->input->post('department'));
		$this->session->set_userdata('post_data', $post_data);
	}

	/**
	 * setup the drop down menu for the date of birth.
	 * 
	 * @access public
	 * @return object
	 */
	function setup_date_menu()
	{
		$this->load->library('formdate');
		$formdate = new FormDate();
		$formdate->setLocale('nl_BE');
		$formdate->year['start'] = 1950;
		$formdate->year['end'] = 2020;
		$formdate->month['values'] = 'numbers';
		$formdate->config['prefix']="dob_";
		return $formdate;
	}
	
	/**
	 * validate the date selected from the drop down menu. return
	 * true if valid, else false.
	 * 
	 * @access public
	 * @return boolean
	 */
	function valid_date()
	{
	    if (!checkdate($this->input->post('dob_month'), $this->input->post('dob_day'), $this->input->post('dob_year')))
	    {
	        $this->form_validation->set_message('valid_date', 'The %s field is invalid.');
	        return FALSE;
	    }
	} 
}
?>