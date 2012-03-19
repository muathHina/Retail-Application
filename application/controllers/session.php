<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start(); //call PHP session object
 
class Session extends CI_Controller {
 	
	function __construct()
	{
 		parent::__construct();
 	}
 	
 	function index()
 	{
 
	}
	
	function get_emp_name()
	{
		$session_data = $this->session->userdata('login_session');
 		$data['name'] = $session_data['name'];
		return $data;
	}
	
	function logout()
	{
		$this->session->unset_userdata('login_session');
		session_destroy();
		redirect('login', 'refresh');
	}
}
?>