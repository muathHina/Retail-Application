<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start(); //call PHP session object
 
class Home extends CI_Controller {
 	
	function __construct()
	{
 		parent::__construct();
 	}
 	
 	/**
 	 * First the method will check to see if there is a session object
 	 * created which means a user has permission to access the page. if not
 	 * the user is directed to the login page. 
 	 * 
 	 * Else the method will setup the home View once the user login from 
 	 * the login page. It will get the user name logged in, it will set the 
 	 * page title and the name of the main page to load which is 'home_view'.
 	 * 
 	 */
 	function index()
 	{
 		if($this->session->session_live())
 		{
 			$data['name'] = $this->session->get_name();
 			$data['title'] = 'Ximbar Home Page';
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
	 * This method will logout user and destroy the session created.
	 * The user will be redirected to the login page.
	 * 
	 */
	function logout()
	{
		$this->session->unset_userdata('login_session');
		session_destroy();
		redirect('login', 'refresh');
	}
}
?>