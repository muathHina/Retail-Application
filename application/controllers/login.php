<?php 

class Login extends CI_Controller
{
	function index()
	{
		$data['content'] = 'login_view';
		$this->load->view('main/template', $data);
	}
}



?>