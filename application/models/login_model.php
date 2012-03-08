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
	
	function verifyRegisteration($empID, $dob)
	{
		$query = $this->db->get_where('employee', array('emp_id' => $empID, 'dob' => $dob));
		if($query -> num_rows == 1) return true;
		else return false;
	}
	
	/*
	 * will set a password for the specified employee ID
	 */
	function setPassword($empID, $pass)
	{
		$data = array('password' => $pass);
		$this->db->where('emp_id', $empID);
		$this->db->update('employee', $data);
	}
	
	/*
	 * checks if password field is empty, not set.
	 * new users will complete registeration by
	 * setting their password. if password not 
	 * empty then the user is already registered. 
	 */
	function passwordIsEmpty($empID)
	{
		$query = $this->db->get_where('employee', array('emp_id' => $empID, 'password' => ''));
		if($query -> num_rows == 1) return true;
		else return false;
	}
}
?> 