<?php 

class Add_emp extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('calendar');
	}
	
	function index()
	{
		$data['name'] = $this->session->get_name();
 		$data['title'] = 'Add Employee';
		$data['nav'] = 'menu';
	 	$data['main'] = 'add_emp_view';
		$this->load->view('content/template', $data);
	}
}
?>