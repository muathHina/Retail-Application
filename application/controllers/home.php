<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start(); //call PHP session object
 
class Home extends CI_Controller {
 	
	function __construct()
	{
 		parent::__construct();
 	}
 	
 	function index()
 	{
 		if($this->session->session_live())
 		{
 			$data['name'] = $this->session->get_name();
 			$data['title'] = 'Ximbar Home Page';
			$data['nav'] = 'menu';
	 		$data['main'] = 'home_view';
			$this->load->view('content/template', $data);
 		}
 		else
 		{
 			 //If no session, redirect to login page
 			 redirect('login', 'refresh');
 		}
	}
	
	
	function logout()
	{
		$this->session->unset_userdata('login_session');
		session_destroy();
		redirect('login', 'refresh');
	}
}
?>