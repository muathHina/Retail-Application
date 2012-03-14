 <?php 
 
 class Home extends CI_Controller {
 	
 	function __construct(){
 		parent::__construct();
 	}
 	
 	function index()
 	{
 		$data['title'] = 'Ximbar Home Page';
		$data['nav'] = 'menu';
 		$data['content'] = 'home_view';
		
		$this->load->view('main/template', $data);
 	}
 }
 
 
 ?>