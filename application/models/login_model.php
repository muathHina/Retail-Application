<?php 

class Login_model extends CI_Model {
	/* 
	 * check the login details against the database.
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
	
	function updatePassword($empID, $pass)
	{
		$data = array('password' => $pass);
		$this->db->where('id', $id);
		$this->db->update('employee', $data); 
	}
}
?> 