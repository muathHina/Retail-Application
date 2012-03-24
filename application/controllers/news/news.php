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
	function index($status = '', $error = '')
	{
		if($this->session->session_live())
 		{
 			$this->news_model->empty_session_table(); // new start
 			$data['all_articles'] = $this->news_model->read_all_articles();
 			$data['status'] = $status;
 			$data['breadcrumb1'] = 'News';
			$data['breadcrumb2'] = 'Read Articles';
 			$data['name'] = $this->session->get_name();
 			$data['page_title'] = 'Read News';
	 		$data['main'] = 'news/read_all_articles_view';
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
			$data['breadcrumb2'] = 'Create Article';
			$data['error'] = $error;
 			$data['status'] = $status;
			$data['name'] = $this->session->get_name();
 			$data['page_title'] = 'Create Article';
	 		$data['main'] = 'news/create_edit_article_view';
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
	function validate_input($n_id = '')
	{ 	          	
		$this->form_validation->set_rules('title', 'title', 'trim|required|alpha_dash_space|max_length[80]');
		$this->form_validation->set_rules('message', 'message', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
		
		if($this->form_validation->run() == FALSE)
		{	// if form data has been temporary saved then we are in the stage of editing the data
			if($this->news_model->form_data_exist())
			{
				$this->edit_temp_article();
			}
			else
			{
				$this->form_news(); // new start
			}
		}
		else
		{
			$this->save_data_temp();
			$this->confirm_info($n_id);
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
	function confirm_info($n_id = '')
	{	// retrieve news data from the session table
		$n_data = $this->news_model->get_form_data_temp();
		// pass all data to the View
		$data['n_id'] = $n_id;
		$data['title'] = $n_data['title'];
		$data['message'] = $n_data['message'];
		
		$data['breadcrumb1'] = 'News';
		$data['breadcrumb2'] = 'Create Article';
		$data['breadcrumb3'] = 'Confirm';
 		$data['name'] = $this->session->get_name();
 		$data['page_title'] = 'Article - confirm information';
		$data['main'] = 'news/confirm_article_view';
		$this->load->view('content/template', $data);
	}
	
	/**
	 * this will get all the data from the news form and save it 
	 * temporary in the database to be confirmed later. This will 
	 * help to retrieve data if needed for editing before permanently
	 * saving it to the database.
	 * 
	 * The table session in the db is a temporary place where data 
	 * can be stored and retrieved, and deleted once processing is 
	 * finished.
	 * 
	 * @access public
	 */
	function save_data_temp()
	{
		$this->news_model->empty_session_table(); //empty table, new start.
		$title = $this->input->post('title');
		$msg = $this->input->post('message');
		$this->news_model->save_form_data_temp($title, $msg);
	}
	
	/**
	 * This will publish news and save it permamnently in the database
	 * 
	 * @access public
	 */
	function publish_article($n_id = '')
	{
		$this->news_model->save_form_data_permanently($n_id);
		$this->index();
	}
	
	/**
	 * this will retrieve an article data from the database and 
	 * pass it to the specified view for reading.
	 * 
	 * @access public
	 * @param integer
	 */
	function read_article($n_id ='')
	{
		if($this->session->session_live())
 		{
 			$data['article'] = $this->news_model->read_article($n_id);
 			$data['breadcrumb1'] = 'News';
			$data['breadcrumb2'] = 'Read Article';
			$data['breadcrumb3'] = $data['article']['title'];
 			$data['name'] = $this->session->get_name();
 			$data['page_title'] = 'Read Article';
	 		$data['main'] = 'news/read_article_view';
			$this->load->view('content/template', $data);
 		}
 		else
 		{
 			 //If no session, redirect to login page
 			 redirect('login', 'refresh');
 		};
	}
	
	/**
	 * The method will edit an article. There are two conditions:
	 * 
	 * 1- if the article exist in the databse(permanent) and the session
	 * table contain new data, then we pass the new data in the session 
	 * table with the existing article id number from news table. So after
	 * editing we update the existing article with the new data.
	 * 
	 * 2- else if no session data exist the method will pass the the 
	 * existing article data for the specified view for editing.
	 * 
	 * @access public
	 * @param integer
	 */
	function edit_article($n_id ='')
	{
		if($this->news_model->article_exist($n_id) && $this->news_model->form_data_exist())
		{
			$data['edit_data'] = $this->news_model->get_form_data_temp();
			$data['edit_data']['n_id'] = $n_id;
		}
		else {
			$data['edit_data'] = $this->news_model->read_article($n_id);
		}
		$data['breadcrumb1'] = 'News'; //
		$data['breadcrumb2'] = 'Edit Article'; //
		$data['name'] = $this->session->get_name(); //
	 	$data['page_title'] = 'Edit Article'; //
		$data['main'] = 'news/create_edit_article_view';
		$this->load->view('content/template', $data);	
	}
	
	/**
	 * this will delete an article permanently from the database.
	 * The article id number is specified in the parameter.
	 * 
	 * @param string
	 */
	function delete_article($n_id ='')
	{
		$result = $this->news_model->delete_article($n_id);
		if($result)
		{
			$this->index('Article deleted successfully.', '');
		}
		else
		{
			$this->index('', 'An error occurred. Article not deleted');
		}
	}
	
	/**
	 * this will delete an article permanently from the database.
	 * The article id number is specified in the parameter.
	 * 
	 * @param string
	 */
	function confirm_delete_article($n_id ='')
	{	
		$data['article'] = $this->news_model->read_article($n_id);
 		$data['breadcrumb1'] = 'News';
		$data['breadcrumb2'] = 'Delete Article';
		$data['breadcrumb3'] = $data['article']['title'];
 		$data['name'] = $this->session->get_name();
 		$data['page_title'] = 'Delete Article';
	 	$data['main'] = 'news/confirm_delete_article_view';
		$this->load->view('content/template', $data);
	}	
}
?>