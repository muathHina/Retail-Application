<?php 

class Login_model extends CI_Model {
	
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
	function verify_login($empID, $pass)
	{
		$this->db->SELECT('emp_id, dep_id, password');
		$this->db->FROM('employee');
		$this->db->WHERE('emp_id', $empID);
		$this->db->WHERE('password', MD5($pass)); 
			
		$query = $this->db->get();
		if($query->num_rows == 1)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}
?> 