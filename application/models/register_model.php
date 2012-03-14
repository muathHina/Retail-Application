<?php

class Register_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * 
	 * @access	public
	 * @param	string
	 * @return	boolean
	 */
	function is_employee($empID, $fname, $lname)
	{
		$query = $this->db->get_where('employee', array('emp_id' => $empID, 'fname' => $fname, 'lname' => $lname));
		return $query -> num_rows == 1;
	}
	
	/**
	 * 
	 * @access	public
	 * @param	string
	 * @return	boolean
	 */
	function set_password($empID, $pass)
	{
		$data = array('password' => MD5($pass));
		$this->db->where('emp_id', $empID);
		$this->db->update('employee', $data);
	}
	
	/**
	 * 
	 * @access	public
	 * @param	string
	 * @return	boolean
	 */
	function employee_registered($empID)
	{
		$query = $this->db->get_where('employee', array('emp_id' => $empID, 'password' => ''));
		return $query->num_rows == 1;
	}
	
}
?>