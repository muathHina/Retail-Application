<?php 

class Add_emp extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('add_emp_model');
	}
	/**
	 * load the add employee page from the view
	 */
	function index($error ='')
	{
		$data['formdate'] = $this->setup_date_menu();
		$data['jobtype'] = $this->add_emp_model->enum_select('employee' , 'jobtype');
		$data['department'] = $this->add_emp_model->get_list_department();
		$data['error'] = $error;
		$data['name'] = $this->session->get_name();
 		$data['title'] = 'Add Employee';
		$data['nav'] = 'menu';
	 	$data['main'] = 'add_emp_view';
		$this->load->view('content/template', $data);
	}
	
	/**
	 * validate the input data from the form
	 * @return string
	 */
	function validate_input()
	{ 	          	
		$this->form_validation->set_rules('fname', 'first name', 'trim|required|xss_clean|alpha');
		$this->form_validation->set_rules('lname', 'last name', 'trim|required|xss_clean|alpha');
		$this->form_validation->set_rules('dob', 'date of birth', 'trim|required|xss_clean|callback_valid_date');
		$this->form_validation->set_rules('phone', 'phone number', 'trim|required|xss_clean|numeric|max_length[11]');
		$this->form_validation->set_rules('email', 'email address', 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('houseno', 'house number', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('sname', 'street name', 'trim|required|xss_clean|alpha');
		$this->form_validation->set_rules('city', 'city name', 'trim|required|xss_clean|alpha');
		$this->form_validation->set_rules('county', 'county name', 'trim|required|xss_clean|alpha');
		$this->form_validation->set_rules('postcode', 'post code', 'trim|required|xss_clean|alpha');
		$this->form_validation->set_rules('jobtype', 'job type', 'trim|required|xss_clean|alpha');
		$this->form_validation->set_rules('department', 'department', 'trim|required|xss_clean|alpha');
		$this->form_validation->set_rules('datejoined', 'date joined', 'trim|required|xss_clean|callback_valid_date');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else if (!$this->Valid_Date_Format($date))
		{
			$this->index('Invalid username or password');
		}
		else
		{
			redirect('home', 'refresh');
		}
	}

	  
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
	
	function valid_date()
	{
	    if (!checkdate($this->input->post('month'), $this->input->post('day'), $this->input->post('year')))
	    {
	        $this->validation->set_message('valid_date', 'The %s field is invalid.');
	        return FALSE;
	    }
	} 
	
}
?>