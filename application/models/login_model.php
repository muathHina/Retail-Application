<?php 

class Login_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}
	
	/* 
	 * check the login details against the database. return
	 * true if details are correct, else false.
	 */
	function verifyLogin($empID, $pass)
	{
		$this->db->select('emp_id, dep_id, password');
		$this->db->from('employee');
		$this->db->where('emp_id', $empID);
		$this->db->where('password', MD5($pass));  
		
		$query = $this->db->get();
		if($query -> num_rows == 1) return true;
		else return false;
	}
}
?> 