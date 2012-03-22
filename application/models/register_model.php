<?php

class Register_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * This method will check to see if the user with the specific
	 * employee id, first and last name does actually exist in the
	 * database, if so will return TRUE, else FALSE.
	 * 
	 * @access	public
	 * @param	integer, string, string
	 * @return	boolean
	 */
	function is_employee($empID, $fname, $lname)
	{
		$query = $this->db->get_where('employee', array('emp_id' => $empID, 'fname' => $fname, 'lname' => $lname));
		return $query -> num_rows == 1;
	}
	
	/**
	 * this will set a password for the user with the specific 
	 * employee id.
	 * 
	 * @access	public
	 * @param	integer, string
	 */
	function set_password($empID, $pass)
	{
		$data = array('password' => MD5($pass));
		$this->db->where('emp_id', $empID);
		$this->db->update('employee', $data);
	}
	
	/**
	 * This method will check to see if a user with the specific employee
	 * id is registered on the database. The criteria is to check the
	 * password field, if its empty then the user is not registered it
	 * returns FALSE, but if it is set then the user is already registered
	 * and it return TRUE.
	 * 
	 * @access	public
	 * @param	integer
	 * @return	boolean
	 */
	function employee_registered($empID)
	{
		$query = $this->db->get_where('employee', array('emp_id' => $empID, 'password' => ''));
		return $query->num_rows == 1;
	}
	
}
?>