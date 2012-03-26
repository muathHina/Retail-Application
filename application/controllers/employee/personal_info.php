<?php 
class Personal_info extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('personal_info_model');
		$this->load->model('login_model');
	}
	
	function index($status = '')
	{
		if($this->session->session_live())
 		{
 			$this->session->unset_userdata('post_data'); // clear session data
 			$data['personal_info'] = $this->personal_info_model->get_employee_info();
 			$data['status'] = $status;
			$data['breadcrumb1'] = 'Employee';
			$data['breadcrumb2'] = 'Personal information';
			$data['name'] = $this->session->get_name();
	 		$data['page_title'] = 'Personal information';
		 	$data['main'] = 'employee/view_personal_info_view';
			$this->load->view('content/template', $data);
 		}
		else
 		{
 			 //If no session, redirect to login page
 			 redirect('login', 'refresh');
 		}
	}
	
	function edit_personal_info()
	{
		if($this->session->userdata('post_data'))
		{
			$data['post_data'] = $this->session->userdata('post_data');
		}
		$data['personal_info'] = $this->personal_info_model->get_employee_info();
		$data['breadcrumb1'] = 'Employee';
		$data['breadcrumb2'] = 'Edit personal information';
		$data['name'] = $this->session->get_name();
	 	$data['page_title'] = 'Edit personal information';
		$data['main'] = 'employee/edit_personal_info_view';
		$this->load->view('content/template', $data);
	}
	
	/**
	 * validate the input data from the form
	 * 
	 * @access
	 */
	function validate_input()
	{ 	          	
		$this->form_validation->set_rules('phone', 'phone number', 'trim|required|numeric|max_length[11]');
		$this->form_validation->set_rules('email', 'email address', 'trim|required|valid_email');
		$this->form_validation->set_rules('house_no', 'house number', 'trim|required|numeric');
		$this->form_validation->set_rules('street', 'street name', 'trim|required|alpha_dash_space');
		$this->form_validation->set_rules('city', 'city name', 'trim|required|alpha_dash_space');
		$this->form_validation->set_rules('county', 'county name', 'trim|required|alpha_dash_space');
		$this->form_validation->set_rules('post_code', 'post code', 'trim|required|alpha_dash_space|max_length[8]');
		$this->form_validation->set_rules('current_password', 'current_password', 'callback_valid_password');
		$this->form_validation->set_rules('newpassword', 'new password', 'trim|min_length[6]|max_length[32]');
		$this->form_validation->set_rules('passwordconf', 'confirm password', 'trim|matches[newpassword]');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->set_data_session();
			$this->edit_personal_info();
		}
		else
		{
			$this->session->unset_userdata('post_data');
			$this->update_personal_info();
		}
	}
	
	/**
	 * get some of the data from the form and save it in 
	 * a session object. This will help to retrieve data
	 * at later stage for editing
	 * 
	 * @access public
	 */
	function set_data_session()
	{	//unset if exist, when we edit we need to unset and set the new data.
		$this->session->unset_userdata('post_data'); 
		$post_data = array(
				'phone'=>$this->input->post('phone'),
				'email'=>$this->input->post('email'),
				'house_no'=>$this->input->post('house_no'),
				'street'=>$this->input->post('street'),
				'city'=>$this->input->post('city'),
				'county'=>$this->input->post('county'),
				'post_code'=>$this->input->post('post_code'));
		$this->session->set_userdata('post_data', $post_data);
	}
	
	/**
	 * this method will get the data from the personal information
	 * form and will pass it to the Model so the database will be 
	 * update with the new data.
	 * 
	 * @access public
	 */
	function update_personal_info()
	{
		$n_pass = $this->input->post('newpassword');
		$pass_conf = $this->input->post('passwordconf');
		
		$data = array(
				'phone'=>$this->input->post('phone'),
				'email'=>$this->input->post('email'),
				'house_no'=>$this->input->post('house_no'),
				'street'=>$this->input->post('street'),
				'city'=>$this->input->post('city'),
				'county'=>$this->input->post('county'),
				'post_code'=>$this->input->post('post_code'));
		if(!empty($n_pass) && !empty($pass_conf))
		{
			$data['password'] = MD5($n_pass); //set new password
		}
		$this->personal_info_model->update_personal_info($data);
		$this->index('Your information has been updated.');
	}
	
	/**
	 * this will verify the password entered. will return TRUE
	 * if password entered matches the password for the specified
	 * employee id.
	 * 
	 * @access public
	 * @return boolean
	 */
	function valid_password()
	{
		$emp_id = $this->session->get_emp_id();
		$pass = $this->input->post('current_password');
		$this->form_validation->set_message('valid_password', 'The current password must be valid.');
		return $this->login_model->verify_login($emp_id, $pass);
	}
}
?>