<?php 

class Add_emp extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
 		$data['title'] = 'Add Employee';
		$data['nav'] = 'menu';
	 	$data['main'] = 'add_emp';
		$this->load->view('content/template', $data);
	}
}
?>