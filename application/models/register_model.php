<?php

class Register_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	/*
	 * checks if the employee id and date of birth macthes the
	 * one stored in the database and return true if so, else
	 * false.
	 */
	function isEmployee($empID, $fname, $lname)
	{
		$query = $this->db->get_where('employee', array('emp_id' => $empID, 'fname' => $fname, 'lname' => $lname));
		if($query -> num_rows == 1) return true;
		else return false;
	}
	
	/*
	 * this will set a password for the specified employee  id
	 */
	function setPassword($empID, $pass)
	{
		$data = array('password' => MD5($pass));
		$this->db->where('emp_id', $empID);
		$this->db->update('employee', $data);
	}
	
	/*
	 * checks if password field in the database for the employee id specified
	 * is empty. New users will complete registeration by setting their 
	 * password and if the password field is not empty then the user is 
	 * already registered thus will return false
	 */
	function empNotRegistered($empID)
	{
		$query = $this->db->get_where('employee', array('emp_id' => $empID, 'password' => ''));
		if($query -> num_rows == 1) return true;
		else return false;
	}
	
}
?>