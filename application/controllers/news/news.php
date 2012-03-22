<?php 

class News extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('news_model');
	}
	
	/**
	 * setup the news form for the user to fill in the title
	 * and the message. Will first check if user is logged in
	 * through the session object.
	 * 
	 * @access public
	 */
	function index()
	{
		if($this->session->session_live())
 		{
 			$data['all_news'] = $this->news_model->read_all_news();
 			$data['breadcrumb1'] = 'News';
			$data['breadcrumb2'] = 'Read';
 			$data['name'] = $this->session->get_name();
 			$data['title'] = 'Read News';
	 		$data['main'] = 'news/read_news_view';
			$this->load->view('content/template', $data);
 		}
 		else
 		{
 			 //If no session, redirect to login page
 			 redirect('login', 'refresh');
 		}
	}
	
	/**
	 * setup the news form for the user to fill in the title
	 * and the message. Will first check if user is logged in
	 * through the session object.
	 * 
	 * @access public
	 */
	function form_news($status = '', $error = '')
	{
		if($this->session->session_live())
 		{
 			$this->news_model->empty_session_table(); // new start
 			$data['breadcrumb1'] = 'News';
			$data['breadcrumb2'] = 'Create';
			$data['error'] = $error;
 			$data['status'] = $status;
			$data['name'] = $this->session->get_name();
 			$data['title'] = 'Create News';
	 		$data['main'] = 'news/create_news_view';
			$this->load->view('content/template', $data);
 		}
 		else
 		{
 			 //If no session, redirect to login page
 			 redirect('login', 'refresh');
 		}
	}
	
	/**
	 * will validate the form news data input from the form. if no error encountered
	 * data will be saved temporary so then the user can confirm the information entered
	 * or edit it if needed.
	 * 
	 * @access public
	 */
	function validate_input()
	{ 	          	
		$this->form_validation->set_rules('n_title', 'title', 'trim|required|alpha_dash_space|max_length[80]');
		$this->form_validation->set_rules('message', 'message', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
		
		if($this->form_validation->run() == FALSE)
		{	// if form data has been entered then we are in the stage of editing the data
			if($this->news_model->form_data_exist())
			{
				$this->edit_news();
			}
			else
			{
				$this->form_news(); // new start
			}
		}
		else
		{
			$this->save_data_temp();
			$this->confirm_info();
		}
	}
	
	/**
	 * setup the news data confirmation page. 
	 * 
	 * In the View the user can confirm the data entered is correct 
	 * which will then be saved permanently. Or if needed go back 
	 * and edit the data entered and then confirm the modification.
	 * 
	 * @access public
	 */
	function confirm_info()
	{	// retrieve news data from the session table
		$n_data = $this->news_model->get_form_data_temp();
		// pass all data to the View
		$data['n_title'] = $n_data['n_title'];
		$data['message'] = $n_data['message'];
		
		$data['breadcrumb1'] = 'News';
		$data['breadcrumb2'] = 'Create';
		$data['breadcrumb3'] = 'Confirm Information';
 		$data['name'] = $this->session->get_name();
 		$data['title'] = 'News - confirm information';
		$data['main'] = 'news/confirm_news_view';
		$this->load->view('content/template', $data);
	}
	
	/**
	 * setup the edit page for the news data entered previously. News
	 * data will be retrieved from database and passed to the View.
	 * 
	 * @access public
	 */
	function edit_news()
	{
		$data['edit_data'] = $this->news_model->get_form_data_temp(); //retrieve data and pass it to the view
		$data['breadcrumb1'] = 'News';
		$data['breadcrumb2'] = 'Create';
		$data['breadcrumb3'] = 'Edit';
		$data['name'] = $this->session->get_name();
	 	$data['title'] = 'Edit News';
		$data['main'] = 'news/create_news_view';
		$this->load->view('content/template', $data);
		
	}
	
	/**
	 * get all the data from the news form and save it 
	 * temporary in the database to confirm it later, and
	 * save permanently in the database.As well this will 
	 * help to retrieve data at later stage for editing.
	 * 
	 * The table session in the db is a temporary place where
	 * data can be stored and retrieved, and deleted once
	 * processing is finished.
	 * 
	 * @access public
	 */
	function save_data_temp()
	{
		$this->news_model->empty_session_table(); //empty table, new start.
		$n_title = $this->input->post('n_title');
		$msg = $this->input->post('message');
		$this->news_model->save_form_data_temp($n_title, $msg);
	}
	
	/**
	 * This will publish news and save it permamnently in the database
	 * 
	 * @access public
	 */
	function publish_news()
	{
		$this->news_model->save_form_data_permanently();
		$this->form_news('News has been published successfully.', '');
	}
	
	/**
	 * 
	 */
	function read_all_news()
	{
		return $this->news_model->read_all_news();
		
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param integer
	 */
	function read_news($id ='')
	{
		;
	}
}
?>